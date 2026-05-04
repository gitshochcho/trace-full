<?php
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\Content;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;
use Propaganistas\LaravelPhone\Rules\Phone;
use Carbon\Carbon;


if (! function_exists('validationError')) {
 function validationError($validator)
 {

            $errors = $validator->errors();
            $errorResponse = [];
            foreach ($errors->messages() as $field => $messages) {
                $errorResponse[] = [
                    'field' => $field,
                    'message' => $messages[0],
                ];
            }
       return $errorResponse;
 }
}
 if (! function_exists('sendSms')) {
    function sendSms($mobile,$message)
    {
        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = "LOT6oU5qFxxey42Ijqug";
        $senderid = "8809617615215";
        // $mobile = $request->input('mobile'); // Assuming the mobile number is passed in the request
        $msg = $message;   // Assuming the message is passed in the request
        $number = $mobile;

        $response = Http::asForm()->post($url, [
            'api_key' => $api_key,
            'senderid' => $senderid,
            'number' => $number,
            'message' => "কারিকুলাম পোর্টাল থেকে স্বাগতম। আপনার ভেরিফিকেশন কোডটি ".$msg,
        ]);
        Log::debug($response->body());
        if ($response->successful()) {
            // Success
            return "success";
        } else {
            // Error
            return "fail";
        }
    }
}

if (! function_exists('validationMobileNumber')) {
    function validationMobileNumber($mobileNumber,$iso = 'BD')
    {
        $phone = new PhoneNumber($mobileNumber, $iso);
       $generatedPhone =  $phone->formatForMobileDialingInCountry($iso);
        return  $generatedPhone;
    }
   }

   if (! function_exists('limitVerification')) {
    function limitVerification($user)
    {
        $currentOtpDate = Carbon::parse(Carbon::now()->toDateString()) ;

        $dbOtpDate = Carbon::parse($user->otp_date);
        $code = rand(100000,999999);

        if($currentOtpDate->eq($dbOtpDate))
        {
                if ($user->otp_count <= (int) config('app.max_otp') ?? 10)
                    {
                        $otpValidateTime = (int) config('app.otp_time');
                        $user->otp = $code;
                        $user->otp_validate_time = Carbon::now()->addMinutes($otpValidateTime);
                        $user->save();
                        $user->increment('otp_count');
                        $phoneNumber = validationMobileNumber($user->phone);
                        sendSms($phoneNumber, $code);
                        return true;


                    }

                    else
                    {
                        return false;

                    }



        }

        else
        {
            $otpValidateTime = (int)  config('app.otp_time');
            $user->otp = $code;
            $user->otp_validate_time = Carbon::now()->addMinutes($otpValidateTime);
            $user->otp_date =  Carbon::now()->toDateString();
            $user->otp_count = 1;
            $user->save();
            $phoneNumber = validationMobileNumber($user->phone);
            sendSms($phoneNumber, $code);
            return true;
        }
    }
   }

   if (! function_exists('storeOtp')) {
    function storeOtp($clientObject,$otp)
    {
        $clientObject->update([
            'otp'=>$otp
        ]);
        return true;
    }
   }

if (! function_exists('siteSettings')) {
    function siteSettings()
    {
        return Cache::remember('site_settings', now()->addHour(), function () {
            return Setting::query()->first();
        });
    }
}

if (! function_exists('siteSetting')) {
    function siteSetting($key = null, $default = null)
    {
        $settings = siteSettings();

        if (! $settings) {
            return $key === null ? null : $default;
        }

        if ($key === null) {
            return $settings;
        }

        $value = data_get($settings, $key);

        if ($value === null || $value === '') {
            return $default;
        }

        return $value;
    }
}

if (! function_exists('siteSettingImage')) {
    function siteSettingImage($path = null, $default = null)
    {
        if (! $path) {
            return $default;
        }

        return asset('storage/' . ltrim($path, '/'));
    }
}

if (! function_exists('contentBlock')) {
    function contentBlock(string $slug): ?Content
    {
        $normalizedSlug = Str::slug($slug);
        $cacheKey = "content_block_{$normalizedSlug}";

        $cached = Cache::get($cacheKey);
        if ($cached instanceof Content) {
            return $cached;
        }

        $slugVariants = array_values(array_unique([
            $slug,
            $normalizedSlug,
            str_replace('-', ' ', $normalizedSlug),
            str_replace(' ', '-', trim($slug)),
            str_replace('_', '-', trim($slug)),
        ]));

        $content = Content::query()
            ->with('media')
            ->whereIn('slug', $slugVariants)
            ->orWhereIn('section', [
                strtoupper(str_replace('-', ' ', $normalizedSlug)),
                strtoupper(trim($slug)),
            ])
            ->latest('id')
            ->first();

        if ($content) {
            Cache::put($cacheKey, $content, now()->addHour());
        }

        return $content;
    }
}

if (! function_exists('stripPTags')) {
    /**
     * Strip <p> tags from HTML content while preserving other formatting
     * Useful for cleaning CKEditor output when we want plain text with basic formatting
     *
     * @param string|null $content
     * @return string|null
     */
    function stripPTags(?string $content): ?string
    {
        if (empty($content)) {
            return $content;
        }

        // Remove opening <p> and closing </p> tags but keep content inside
        $content = preg_replace("/<p[^>]*>/", "", $content);
        $content = preg_replace("/<\\/p>/", "", $content);

        // Clean up extra whitespace but preserve line breaks from other elements
        $content = trim($content);

        return $content;
    }
}

if (! function_exists('abbreviateClientName')) {
    /**
     * Abbreviate client name: >3 words → acronym; ≤3 words → as-is
     * Example: "Plant Research & Training Centre" (4 words) → "PRTC"
     * Example: "ABC Corp" (2 words) → "ABC Corp"
     *
     * @param string|null $clientName
     * @return string|null
     */
    function abbreviateClientName(?string $clientName): ?string
    {
        return $clientName ? trim($clientName) : $clientName;
    }
}
