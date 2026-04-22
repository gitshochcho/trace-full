<?php

namespace App\Http\Controllers;


use App\Models\Partner;
use App\Mail\ForgetPassMail;
use App\Models\Content;
use App\Models\Country;
use App\Models\Gender;
use App\Models\Insight;
use App\Models\InsightArticle;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Team;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\RedirectResponse;
use App\Models\ContactInfo;
use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator ;
use Laravel\Socialite\Facades\Socialite;
use Propaganistas\LaravelPhone\Rules\Phone;

class HomeController extends Controller
{

    public function home(Request $request)
    {
        $slider = Slider::with('media')->first();

        $homeServices = Service::query()
        ->with(['content', 'media', 'solutions'])
        ->where('active', true)
        ->orderBy('sort_order')
        ->limit(6)
        ->get();

    // Projects — latest 3টা
    $homeProjects = Project::query()
        ->with(['services', 'media'])
        ->orderBy('sort_order')
        ->latest('id')
        ->limit(3)
        ->get();

        return view('frontend.pages.home', compact('slider', 'homeServices', 'homeProjects'));
    }

     public function services(Request $request)
    {
        $servicesHero = contentBlock('services-page');
        $workWithUs = contentBlock('work-with-us');

        $services = Service::query()
            ->with(['content', 'media', 'solutions'])
            ->where('active', true)
            ->orderBy('sort_order')
            ->get();

        $serviceCards = $services->map(function (Service $service, int $index) {
            $content = $service->content;
            
            // Get image URL - use asset() if it's just a filename
            $imageUrl = $service->imageUrl() ?? $content?->imageUrl();
            if (!$imageUrl) {
                $imageUrl = asset('assets/img/Trade and Customs.png');
            }

            return [
                'id' => $service->id,
                'img' => $imageUrl,
                'tag' => $content?->section ?? $service->service_name,
                'title' => $content?->heading ?? $service->service_name,
                'desc' => $content?->description ?? '',
                'products' => $service->solutions->isNotEmpty()
                    ? $service->solutions->count() . ' Solutions'
                    : ($content?->type ? $content->type : 'View Service'),
            ];
        })->values();

        return view('frontend.pages.services', compact('servicesHero', 'workWithUs', 'serviceCards'));
    }

      public function serviceDetails(Request $request, $id)
    {
        $service = Service::query()
            ->with(['content', 'details' => function($q) { $q->orderBy('sort_order'); }, 'solutions' => function($q) { $q->orderBy('sort_order'); }, 'media'])
            ->findOrFail($id);

        $otherServices = Service::query()
            ->where('active', true)
            ->orderBy('sort_order')
            ->get(['id', 'service_name']);

        return view('frontend.pages.service-details', compact('service', 'otherServices'));
    }

      public function projects(Request $request)
    {
        $projectsHero = contentBlock('projects-page');

        $services = Service::query()
            ->whereHas('projects')
            ->withCount('projects')
            ->orderBy('service_name')
            ->get();

        $selectedService = $request->integer('service');

        $projects = Project::query()
            ->with(['services', 'media'])
            ->withCount('services')
            ->when($selectedService, function ($query, $serviceId) {
                $query->whereHas('services', function ($serviceQuery) use ($serviceId) {
                    $serviceQuery->where('services.id', $serviceId);
                });
            })
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        return view('frontend.pages.projects', compact('projectsHero', 'services', 'projects', 'selectedService'));
    }

     public function projectdetails(Request $request, ?Project $project = null)
    {
        $project ??= Project::query()
            ->with(['services', 'locations', 'phaseDetails', 'outcomes', 'media'])
            ->orderBy('sort_order')
            ->latest('id')
            ->firstOrFail();

        $project->load(['services', 'locations', 'phaseDetails', 'outcomes', 'media']);

        $relatedProjects = Project::query()
            ->with(['services', 'media'])
            ->whereKeyNot($project->id)
            ->orderBy('sort_order')
            ->latest('id')
            ->take(3)
            ->get();

        return view ('frontend.pages.projectdetails', compact('project', 'relatedProjects'));
    }

    public function insights(Request $request)
    {
        $insightsPageContent = contentBlock('insights-page');

        $insights = Insight::query()
            ->with(['articles.author.media', 'articles.media', 'media'])
            ->where('active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        return view('frontend.pages.insights', compact('insightsPageContent', 'insights'));
    }

        public function articleDetails(Request $request, ?InsightArticle $article = null)
    {
        $article ??= InsightArticle::query()
            ->with(['author.media', 'insight.media', 'media'])
            ->where('active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->firstOrFail();

        $article->load(['author.media', 'insight.media', 'media']);

        $relatedArticles = InsightArticle::query()
            ->with(['insight.media'])
            ->where('active', true)
            ->whereKeyNot($article->id)
            ->orderBy('sort_order')
            ->latest('id')
            ->take(3)
            ->get();

        return view('frontend.pages.article-details', compact('article', 'relatedArticles'));
    }

    public function career(Request $request)
    {
        $jobs = JobPosting::active()->ordered()->paginate(12);
        return view('frontend.pages.career', compact('jobs'));
    }
    public function careerdetails(Request $request, $id)
    {
        $job = JobPosting::active()->findOrFail($id);
        return view('frontend.pages.careerdetails', compact('job'));
    }

    public function applyForJob(Request $request, $id)
    {
        $job = JobPosting::active()->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'cover_letter' => 'nullable|string',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ]);

        // Handle CV upload
        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        JobApplication::create([
            'job_posting_id' => $job->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'cover_letter' => $validated['cover_letter'] ?? null,
            'cv_path' => $cvPath,
            'is_reviewed' => false,
        ]);

        return back()->with('success', 'Your application has been submitted successfully!');
    }

    public function contact(Request $request)
    {
        $heroContent = contentBlock('contact-page');
        $contactPhones = ContactInfo::where('type', 'phone')->active()->ordered()->get();
        $contactEmails = ContactInfo::where('type', 'email')->active()->ordered()->get();
        $contactAddresses = ContactInfo::where('type', 'address')->active()->ordered()->get();
        return view('frontend.pages.contact', compact('heroContent', 'contactPhones', 'contactEmails', 'contactAddresses'));
    }


        public function about(Request $request)
    {
        $aboutPageContent = contentBlock('about-page') ?? contentBlock('about');
            $aboutCommitmentContent = contentBlock('about_us_section_3');
            $aboutFrameworkContent = contentBlock('about_us_how_we_work');
            $aboutUniqueFeaturesContent = contentBlock('about_us_we_make_trace_different');

            $frameworkItems = collect([
                contentBlock('about_us_insight'),
                contentBlock('about_us_strategy') ?? contentBlock('about_us_stratigy'),
                contentBlock('about_us_impact'),
            ])->filter();

            $uniqueFeatureCards = collect([
                contentBlock('about_us_industry_wide_network'),
                contentBlock('about_us_sustainable_approach'),
                contentBlock('about_us_tailored_innovation'),
                contentBlock('about_us_end_to_end_integrated_solutions'),
            ])->filter();

        $aboutProjects = Project::query()
            ->with(['services', 'media'])
            ->orderBy('sort_order')
            ->latest('id')
            ->take(3)
            ->get();

        $aboutInsights = Insight::query()
            ->with(['articles.author.media', 'articles.media', 'media'])
            ->where('active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->take(4)
            ->get();

        return view('frontend.pages.about', compact(
            'aboutPageContent',
            'aboutCommitmentContent',
            'aboutFrameworkContent',
            'frameworkItems',
            'aboutUniqueFeaturesContent',
            'uniqueFeatureCards',
            'aboutProjects',
            'aboutInsights'
        ));
    }

      public function team(Request $request)
    {
        $teamPageContent = contentBlock('team-page');

        $advisors = Team::query()
            ->with(['projects', 'experties.media', 'socialMedia.media', 'media'])
            ->where('type', 2)
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        $teams = Team::query()
            ->with(['experties.media', 'socialMedia.media', 'projects', 'media']) 
            ->where('type', 1)
            ->orderBy('sort_order')         
            ->latest('id')
            ->get();
    
        $leadTeam = $teams->first();
        $coreTeams = $teams->filter(function (Team $member) use ($leadTeam) {
            return ! $leadTeam || $member->id !== $leadTeam->id;
        })->values();

        return view('frontend.pages.team', compact('teamPageContent', 'teams', 'leadTeam', 'coreTeams', 'advisors'));
    }
    
        public function teamdetails(Request $request, ?Team $team = null)
    {
        $team ??= Team::query()
            ->with(['experties.media', 'socialMedia.media', 'projects', 'media'])
            ->orderBy('sort_order')
            ->latest('id')
            ->firstOrFail();

        $team->load(['experties.media', 'socialMedia.media', 'projects', 'media']);

        $otherTeamMembers = Team::query()
            ->with(['media'])
            ->whereKeyNot($team->id)
            ->orderBy('sort_order')
            ->latest('id')
            ->take(3)
            ->get();

        $allTeamMembersCount = Team::query()->count();

        return view('frontend.pages.teamdetails', compact('team', 'otherTeamMembers', 'allTeamMembersCount'));
    }

    public function dashboard(Request $request)
    {

        return view('user.dashboard');
    }

    public function login()
    {
        $datas = Country::all();
        $genders = Gender::all();
        return view('auth.login',compact('datas','genders'));

    }


    public function registration()
    {
        $datas = Country::all();
        $genders = Gender::all();
        return view('auth.register',compact('datas','genders'));

    }


    public function validateLogin(Request $request)
    {
        $countryIso = Country::where('id',18)->first();

        $validated = $request->validate([
            // 'email_or_phone' => ['bail','required','regex:/^[0-9+]+$/',(new Phone)->country([$countryIso->iso])],
            'email_or_phone' => ['bail','required'],

            'password' => 'required',
            ],
            [
                'email_or_phone.regex' => 'The phone number must contain only English digits (0-9).',
                'email_or_phone.required' => 'The phone number is required',
            ]
        );


        $password = $request->input('password');

        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $request->email_or_phone)
            // ->orWhere('phone', $phoneNumber)
            ->first();
        }
        else
        {
            $phoneNumber = validationMobileNumber($request->email_or_phone,$countryIso->iso);
            $user = User::where('email', $request->email_or_phone)
                    ->orWhere('phone', $phoneNumber)
                    ->first();
        }



        if ($user) {
            if (Hash::check($password, $user->password))
            {

                if (($user->status == 0)) {


                    $toster = array(
                        'message' => "This account is in black listed",
                        'alert-type' => 'error'
                    );
                    return back()->with( $toster);

                } else {

                    if ($request->has('remember')) {
                        Auth::guard('web')->login($user, true);
                    } else {
                        Auth::guard('web')->login($user);
                    }
                    $toster = array(
                        'message' => "Wlecome to Dashboard, ".$user->name,
                        'alert-type' => 'success'
                    );

                    return redirect()->route('user.dashboard')->with( $toster);
                }

            }

            else
            {
                return back()->with('fail', 'Wrong Credential');
            }
        }
        else
        {
            $toster = array(
                'message' => "User Not Found",
                'alert-type' => 'error'
            );

            return back()->with( $toster);
        }
    }





    public function storRegistration(Request $request)
    {
        $code = rand(100000,999999);
        $countryID = $request->country_id ?? 18;
        $countryIso = Country::where('id',$countryID)->first();


        $validated = $request->validate([
            'name' => 'required',
            'email' => 'unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
            // 'education_type_id' => 'required',
            'phone' => ['required','unique:users','regex:/^[0-9+]+$/',(new Phone)->country([$countryIso->iso]??['BD']),],
            // 'upazila_id' => 'required',
            // 'district_id' => 'required',
            // 'division_id' => 'required',
            'gender_id' => 'required',
            // 'country_id' => 'required',
            ],
            [
                'phone.regex' => 'The phone number must contain only English digits (0-9).',
                'phone.required' => 'The phone number is required',
            ]
        );


        $phoneNumber = validationMobileNumber($request->phone,$countryIso->iso);

            $user = DB::transaction(function () use($request,$code,$phoneNumber) {
                $userCreate = array(
                    "name" => $request->name,
                    "email" => $request->email ?? null,
                    "password" => Hash::make($request->password),
                    "phone" => $phoneNumber,
                    "otp" => $code,
                    "status" => 1,

                );

                $newuser = User::create($userCreate);

                $userdetail = array(
                    "user_id" => $newuser->id,
                    "division_id" => $request->division_id ?? null,
                    "district_id" => $request->district_id ?? null ,
                    "upazila_id" => $request->upazila_id ?? null ,
                    "union_id" => $request->union_id ?? null ,
                    "education_type_id" => $request->education_type_id ?? null ,
                    "profession_id" => $request->profession_id ?? null ,
                    "gender_id" => $request->gender_id ?? null ,
                    "country_id" => $request->country_id ?? null ,
                    "religion_id" => $request->religion_id ?? null ,
                );
                $userDetail = UserDetail::create($userdetail);

                return $newuser;
            });

            if ($user->status == 1) {
                $toster = array(
                    'message' => "Registration Successfull",
                    'alert-type' => 'success'
                );
                return redirect()->route('login')->with( $toster);

            } else {

                $toster = array(
                    'message' => "Registration Fail",
                    'alert-type' => 'error'
                );
                return redirect()->route('registration')->with( $toster);

            }
    }


    public function googleOauthLoad()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleOauthCallBack()
    {
        $user = Socialite::driver('google')->user();
        dd( $user);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::route('login');
    }

    public function loadForgetMyPass()
    {
        $datas = Country::all();
        return view('auth.forgetpass',compact('datas'));

    }

    public function searchUser(Request $request)
    {
        $countryIso = Country::where('id',18)->first();

        $validated = $request->validate([
            'email_or_phone' => ['bail','required'],
            ],
            [
                'email_or_phone.regex' => 'The phone number must contain only English digits (0-9).',
                'email_or_phone.required' => 'The phone number is required',
            ]
        );

        if (filter_var($request->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $credential = array("email" => $request->email_or_phone);
        }
        else
        {
            $phoneNumber = validationMobileNumber($request->email_or_phone,$countryIso->iso);
            $credential = array("phone" => $phoneNumber);
            $email = false;
        }

        $user = User::where($credential)->first();

        if ($user) {
            $toster = array(
                'message' => 'User Found',
                'alert-type' => 'success'
            );

            return redirect()->route('userOtpLoad')->with('uuid', $user->id)->with($toster);

        }
        else
        {
            $toster = array(
                'message' => 'User Not Found',
                'alert-type' => 'error'
            );

            return back()->with( $toster);
        }
    }


    public function userOtpLoad(Request $request)
    {
        $uuID = session('uuid') ?? $request->uuid;
        $user = User::find($uuID);

        if (!$user) {
            return back()->with([
                'message' => 'User Not Found',
                'alert-type' => 'error'
            ]);
        }

        $randCode = rand(100000,999999);
        $toster = array(
            'message' => 'User Found',
            'alert-type' => 'success'
        );
        $status = storeOtp($user, $randCode);
        $name = $user->name;
        $messageContent = "Your Reset Code is : {$randCode}";

        // Email Code
        if($user->email != null && $status == true)
        {
            Mail::to($user->email)->queue(new ForgetPassMail($name,$messageContent));
        }
        else
        {
            return back()->with([
                'message' => 'Error in otp sending',
                'alert-type' => 'error'
            ]);
        }

        return view('auth.userotp', compact('user'))->with($toster);


    }


    public function validateUserOtp(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|digits:1',
        ]);



        if ($validator->fails()) {
            $toster = array(
                'message' => 'Wrong OTP',
                'alert-type' => 'error'
            );
            return redirect()->route('forgetMyPass')->with( $toster);
        }

        $otp = preg_replace('/\D/', '', implode('', $request->input('otp')));


        $user = User::find($request->uuid);

        // if ($admin->otp == $request->otp && $admin->otp_validate_time > now())
        if ($user?->otp == $otp)
        {
            $toster = array(
                'message' => 'Otp Matched',
                'alert-type' => 'success'
            );
            return view('auth.passconfirm', compact('user'))->with($toster);
        }
        else
        {
            $toster = array(
                'message' => 'Wrong OTP',
                'alert-type' => 'error'
            );

            return redirect()->route('userOtpLoad')->with('uuid', $user->id)->with($toster);
            // return view('auth.userotp', compact('user'))->with($toster);

        }
    }



    public function updateUserPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ],
        [
            'password.required' => 'The Password is required',
            'password_confirmation.required' => 'The Confirm Password is required',
            'password_confirmation.same' => 'The Confirm Password and Password must match',
        ]
    );

        if ($validator->fails()) {
            $toster = array(
                'message' => $validator->errors()->first(),
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with( $toster);
        }


        $user = User::find($request->uuid);
        $user->password = Hash::make($request->password);
        $user->save();

        $toster = array(
            'message' => 'Password Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('login')->with($toster);
    }


}
