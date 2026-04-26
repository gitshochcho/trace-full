<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Team;
use App\Models\TeamExpertise;
use App\Models\TeamSocialMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with(['experties.media', 'socialMedia.media', 'projects', 'media'])
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        $projects = Project::query()
            ->orderBy('project_title')
            ->get(['id', 'project_title']);

        return view('admin.team.index', compact('teams', 'projects'));
    }

    public function create()
    {
        $projects = Project::query()
            ->orderBy('project_title')
            ->get(['id', 'project_title']);

        return view('admin.team.create', compact('projects'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTeamRequest($request);
        $team = Team::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'designation' => $validated['designation'] ?? null,
            'description' => $this->normalizeEditorText($validated['description'] ?? null),
            'sort_order' => $validated['sort_order'] ?? 0,
            'type' => $validated['type'] ?? 1,
            'headtitle' => $validated['headtitle'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            $team->addMedia($request->file('image'))->toMediaCollection('image');
        }

        $this->syncProjects($team, $validated['projects'] ?? []);
        $this->syncExperties($team, $validated['experties'] ?? [], $request->file('experties_icons', []));
        $this->syncSocialMedia($team, $validated['social_media'] ?? [], $request->file('social_media_icons', []));

        return redirect()
            ->route('admin.teams.index')
            ->with([
                'message' => 'Team member created successfully',
                'alert-type' => 'success',
            ]);
    }

    public function edit(Team $team)
    {
        $team->load(['experties.media', 'socialMedia.media', 'projects', 'media']);

        $teams = Team::with(['projects'])
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        $projects = Project::query()
            ->orderBy('project_title')
            ->get(['id', 'project_title']);

        return view('admin.team.edit', compact('team', 'teams', 'projects'));
    }

    public function update(Request $request, Team $team): RedirectResponse
    {

        // dd($request->all());
        $validated = $this->validateTeamRequest($request, true);

        $team->fill([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'designation' => $validated['designation'] ?? null,
            'description' => $this->normalizeEditorText($validated['description'] ?? null),
            'sort_order' => $validated['sort_order'] ?? 0,
            'type' => $validated['type'],
            'headtitle' => $validated['headtitle'] ?? null,
        ]);
        $team->save();

        if ($request->boolean('remove_image')) {
            $team->clearMediaCollection('image');
        }

        if ($request->hasFile('image')) {
            $team->clearMediaCollection('image');
            $team->addMedia($request->file('image'))->toMediaCollection('image');
        }

        $this->syncProjects($team, $validated['projects'] ?? []);
        $this->syncExperties($team, $validated['experties'] ?? [], $request->file('experties_icons', []));
        $this->syncSocialMedia($team, $validated['social_media'] ?? [], $request->file('social_media_icons', []));

        return redirect()
            ->route('admin.teams.index')
            ->with([
                'message' => 'Team member updated successfully',
                'alert-type' => 'success',
            ]);
    }

    public function destroy(Team $team): RedirectResponse
    {
        $team->load(['experties.media', 'socialMedia.media', 'media']);

        $team->projects()->detach();
        $team->experties->each(function (TeamExpertise $expertise) {
            $expertise->clearMediaCollection('icon');
            $expertise->delete();
        });

        $team->socialMedia->each(function (TeamSocialMedia $social) {
            $social->clearMediaCollection('social_icon');
            $social->delete();
        });

        $team->clearMediaCollection('image');
        $team->delete();

        return redirect()
            ->route('admin.teams.index')
            ->with([
                'message' => 'Team member deleted successfully',
                'alert-type' => 'success',
            ]);
    }

    private function validateTeamRequest(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'type' => ['nullable', 'string', 'in:1,2'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
            'projects' => ['nullable', 'array'],
            'projects.*' => ['nullable', 'integer', 'exists:projects,id'],
            'experties' => ['nullable', 'array'],
            'experties.*.id' => ['nullable', 'integer'],
            'experties.*.heading' => ['nullable', 'string', 'max:255'],
            'experties.*.description' => ['nullable', 'string'],
            'experties_icons' => ['nullable', 'array'],
            'experties_icons.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'social_media' => ['nullable', 'array'],
            'social_media.*.id' => ['nullable', 'integer'],
            'social_media.*.title' => ['nullable', 'string', 'max:255'],
            'social_media.*.social_link' => ['nullable', 'string', 'max:2048'],
            'social_media_icons' => ['nullable', 'array'],
            'social_media_icons.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);
    }

    private function syncProjects(Team $team, array $projectIds): void
    {
        $team->projects()->sync(array_filter(array_map('intval', $projectIds)));
    }

    private function syncExperties(Team $team, array $rows, array $icons): void
    {
        $keptIds = [];


        foreach (array_values($rows) as $index => $item) {
            $rowId = ! empty($item['id']) ? (int) $item['id'] : null;
            $heading = trim((string) ($item['heading'] ?? ''));
            $description = $this->normalizeEditorText($item['description'] ?? null) ?? '';
            $icon = $icons[$index] ?? null;

            if ($heading === '' && $description === '' && ! $icon && $rowId === null) {
                continue;
            }

            $record = $rowId
                ? TeamExpertise::firstOrNew(['id' => $rowId, 'team_id' => $team->id])
                : new TeamExpertise(['team_id' => $team->id]);
         
            $record->team_id = $team->id;
            $record->heading = $heading;
            $record->description = $description;
            $record->sort_order = $index;
            $record->save();



            if ($icon) {
                $record->clearMediaCollection('icon');
                $record->addMedia($icon)->toMediaCollection('icon');
            }

            $keptIds[] = $record->id;
        }

        $team->experties()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each(function (TeamExpertise $expertise) {
                $expertise->clearMediaCollection('icon');
                $expertise->delete();
            });
    }

    private function syncSocialMedia(Team $team, array $rows, array $icons): void
    {
        $keptIds = [];

        foreach (array_values($rows) as $index => $item) {
            $rowId = ! empty($item['id']) ? (int) $item['id'] : null;
            $title = trim((string) ($item['title'] ?? ''));
            $socialLink = trim((string) ($item['social_link'] ?? ''));
            $icon = $icons[$index] ?? null;

            if ($title === '' && $socialLink === '' && ! $icon && $rowId === null) {
                continue;
            }

            $record = $rowId
                ? TeamSocialMedia::firstOrNew(['id' => $rowId, 'team_id' => $team->id])
                : new TeamSocialMedia(['team_id' => $team->id]);

            $record->team_id = $team->id;
            $record->title = $title;
            $record->social_link = $socialLink;
            $record->sort_order = $index;
            $record->save();

            if ($icon) {
                $record->clearMediaCollection('social_icon');
                $record->addMedia($icon)->toMediaCollection('social_icon');
            }

            $keptIds[] = $record->id;
        }

        $team->socialMedia()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each(function (TeamSocialMedia $socialMedia) {
                $socialMedia->clearMediaCollection('social_icon');
                $socialMedia->delete();
            });
    }

    private function normalizeEditorText(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = preg_replace("/<p[^>]*>/i", '', $value);
        $normalized = preg_replace("/<\/p>/i", "\n", (string) $normalized);
        $normalized = preg_replace("/<br\s*\/?\s*>/i", "\n", (string) $normalized);
        $normalized = html_entity_decode(strip_tags((string) $normalized));
        $normalized = preg_replace("/\n{3,}/", "\n\n", (string) $normalized);

        return trim((string) $normalized);
    }
}
