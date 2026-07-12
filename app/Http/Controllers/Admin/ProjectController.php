<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectLocation;
use App\Models\ProjectOutcome;
use App\Models\ProjectPhaseDetail;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['services', 'locations', 'phaseDetails', 'outcomes', 'media'])
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        $services = Service::whereHas('projects')
            ->withCount('projects')
            ->orderBy('sort_order')
            ->orderBy('service_name')
            ->get();

        return view('admin.project.index', compact('projects', 'services'));
    }

    public function create()
    {
        $services = Service::withCount('projects')
            ->orderBy('service_name')
            ->get();

        return view('admin.project.create', compact('services'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'project_title' => ['required', 'string', 'max:255'],
            'client' => ['nullable', 'string', 'max:255'],
            'project_standard' => ['nullable', 'string', 'max:255'],
            'overview' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'project_status' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'services' => ['nullable', 'array'],
            'services.*' => ['nullable', 'integer', 'exists:services,id'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'images' => ['nullable', 'array', 'max:3'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'locations' => ['nullable', 'array'],
            'locations.*.id' => ['nullable', 'integer'],
            'locations.*.location' => ['nullable', 'string'],
            'phases' => ['nullable', 'array'],
            'phases.*.id' => ['nullable', 'integer'],
            'phases.*.phase_description' => ['nullable', 'string'],
            'phases.*.attachment' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'outcomes' => ['nullable', 'array'],
            'outcomes.*.id' => ['nullable', 'integer'],
            'outcomes.*.icon_image' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp,svg,gif', 'max:1024'],
            'outcomes.*.text' => ['nullable', 'string'],
        ]);

        $project = Project::create([
            'project_title' => $validated['project_title'],
            'client' => $validated['client'] ?? null,
            'project_standard' => $validated['project_standard'] ?? null,
            'overview' => $validated['overview'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'project_status' => $validated['project_status'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'show_on_home' => $request->boolean('show_on_home'),
        ]);

        $this->syncServices($project, $validated['services'] ?? []);
        $this->syncHeroImage($project, $request->file('hero_image'));
        $this->syncImages($project, $request->file('images', []));
        $this->syncLocations($project, $validated['locations'] ?? []);
        $this->syncPhases($project, $validated['phases'] ?? [], $request->file('phases', []));
        $this->syncOutcomes($project, $validated['outcomes'] ?? [], $request->file('outcomes', []));

        return redirect()
            ->route('admin.projects.index')
            ->with([
                'message' => 'Project created successfully',
                'alert-type' => 'success',
            ]);
    }

    public function edit(Project $project)
    {
        $project->load(['services', 'locations', 'phaseDetails', 'outcomes', 'media']);
        $projects = Project::with(['services', 'media'])->orderBy('sort_order')->latest('id')->get();
        $services = Service::withCount('projects')->orderBy('service_name')->get();

        return view('admin.project.edit', compact('project', 'projects', 'services'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'project_title' => ['required', 'string', 'max:255'],
            'client' => ['nullable', 'string', 'max:255'],
            'project_standard' => ['nullable', 'string', 'max:255'],
            'overview' => ['nullable', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'project_status' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'services' => ['nullable', 'array'],
            'services.*' => ['nullable', 'integer', 'exists:services,id'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'images' => ['nullable', 'array', 'max:3'],
            'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'locations' => ['nullable', 'array'],
            'locations.*.id' => ['nullable', 'integer'],
            'locations.*.location' => ['nullable', 'string'],
            'phases' => ['nullable', 'array'],
            'phases.*.id' => ['nullable', 'integer'],
            'phases.*.phase_description' => ['nullable', 'string'],
            'phases.*.attachment' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'outcomes' => ['nullable', 'array'],
            'outcomes.*.id' => ['nullable', 'integer'],
            'outcomes.*.icon_image' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,webp,svg,gif', 'max:1024'],
            'outcomes.*.text' => ['nullable', 'string'],
        ]);

        $project->fill([
            'project_title' => $validated['project_title'],
            'client' => $validated['client'] ?? null,
            'project_standard' => $validated['project_standard'] ?? null,
            'overview' => $validated['overview'] ?? null,
            'start_date' => $validated['start_date'] ?? null,
            'end_date' => $validated['end_date'] ?? null,
            'project_status' => $validated['project_status'],
            'sort_order' => $validated['sort_order'] ?? 0,
            'show_on_home' => $request->boolean('show_on_home'),
        ]);
        $project->save();

        $this->syncServices($project, $validated['services'] ?? []);
        $this->syncHeroImage($project, $request->file('hero_image'));
        $this->syncImages($project, $request->file('images', []));
        $this->syncLocations($project, $validated['locations'] ?? []);
        $this->syncPhases($project, $validated['phases'] ?? [], $request->file('phases', []));
        $this->syncOutcomes($project, $validated['outcomes'] ?? [], $request->file('outcomes', []));

        return redirect()
            ->route('admin.projects.index')
            ->with([
                'message' => 'Project updated successfully',
                'alert-type' => 'success',
            ]);
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->load(['locations', 'phaseDetails', 'outcomes', 'media']);

        $project->services()->detach();

        $project->locations()->delete();

        $project->phaseDetails->each(function (ProjectPhaseDetail $phase) {
            if ($phase->attachment) {
                Storage::disk('public')->delete($phase->attachment);
            }
            $phase->delete();
        });

        $project->outcomes->each(function (ProjectOutcome $outcome) {
            if ($outcome->icon && str_starts_with($outcome->icon, 'projects/')) {
                Storage::disk('public')->delete($outcome->icon);
            }
            $outcome->delete();
        });

        $project->clearMediaCollection('hero');
        $project->clearMediaCollection('images');
        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with([
                'message' => 'Project deleted successfully',
                'alert-type' => 'success',
            ]);
    }

    public function destroyImage(Project $project, int $mediaId): JsonResponse
    {
        $media = $project->getMedia('images')->firstWhere('id', $mediaId)
            ?? $project->getMedia('hero')->firstWhere('id', $mediaId);

        if (! $media) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        $media->delete();

        return response()->json(['success' => true]);
    }

    private function syncServices(Project $project, array $serviceIds): void
    {
        $project->services()->sync(array_filter(array_map('intval', $serviceIds)));
    }

    private function syncHeroImage(Project $project, $file): void
    {
        if (! $file) {
            return;
        }

        $project->clearMediaCollection('hero');
        $project->addMedia($file)->toMediaCollection('hero');
    }

    private function syncImages(Project $project, array $images): void
    {
        $existing = $project->getMedia('images')->count();

        foreach ($images as $image) {
            if (! $image) {
                continue;
            }

            if ($existing >= 3) {
                break;
            }

            $project->addMedia($image)->toMediaCollection('images');
            $existing++;
        }
    }

    private function syncLocations(Project $project, array $locations): void
    {
        $keptIds = [];

        foreach (array_values($locations) as $index => $item) {
            $location = $item['location'] ?? null;
            $locationId = ! empty($item['id']) ? (int) $item['id'] : null;

            if ($location === '' && $locationId === null) {
                continue;
            }

            $record = $locationId
                ? ProjectLocation::firstOrNew(['id' => $locationId, 'project_id' => $project->id])
                : new ProjectLocation(['project_id' => $project->id]);

            $record->project_id = $project->id;
            $record->location = $location;
            $record->sort_order = $index;
            $record->save();

            $keptIds[] = $record->id;
        }

        $project->locations()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each->delete();
    }

    private function syncPhases(Project $project, array $phases, array $phaseFiles): void
    {
        $keptIds = [];

        foreach (array_values($phases) as $index => $item) {
            $description = $item['phase_description'] ?? null;
            $phaseId = ! empty($item['id']) ? (int) $item['id'] : null;
            $attachment = $phaseFiles[$index]['attachment'] ?? null;

            if ($description === '' && ! $attachment && $phaseId === null) {
                continue;
            }

            $record = $phaseId
                ? ProjectPhaseDetail::firstOrNew(['id' => $phaseId, 'project_id' => $project->id])
                : new ProjectPhaseDetail(['project_id' => $project->id]);

            $record->project_id = $project->id;
            $record->phase_description = $description;
            $record->sort_order = $index;
            $record->save();

            if ($attachment) {
                if ($record->attachment) {
                    Storage::disk('public')->delete($record->attachment);
                }

                $record->attachment = $attachment->store('projects/phases', 'public');
                $record->save();
            }

            $keptIds[] = $record->id;
        }

        $project->phaseDetails()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each(function (ProjectPhaseDetail $phase) {
                if ($phase->attachment) {
                    Storage::disk('public')->delete($phase->attachment);
                }
                $phase->delete();
            });
    }

    private function syncOutcomes(Project $project, array $outcomes, array $outcomeFiles = []): void
    {
        $keptIds = [];

        foreach (array_values($outcomes) as $index => $item) {
            $text = $item['text'] ?? null;
            $outcomeId = ! empty($item['id']) ? (int) $item['id'] : null;
            $iconFile = $outcomeFiles[$index]['icon_image'] ?? null;

            if ($text === '' && ! $iconFile && $outcomeId === null) {
                continue;
            }

            $record = $outcomeId
                ? ProjectOutcome::firstOrNew(['id' => $outcomeId, 'project_id' => $project->id])
                : new ProjectOutcome(['project_id' => $project->id]);

            $record->project_id = $project->id;
            $record->text = $text;
            $record->sort_order = $index;

            if ($iconFile) {
                if ($record->icon && str_starts_with($record->icon, 'projects/')) {
                    Storage::disk('public')->delete($record->icon);
                }
                $record->icon = $iconFile->store('projects/outcomes', 'public');
            }

            $record->save();

            $keptIds[] = $record->id;
        }

        $project->outcomes()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each(function (ProjectOutcome $outcome) {
                if ($outcome->icon && str_starts_with($outcome->icon, 'projects/')) {
                    Storage::disk('public')->delete($outcome->icon);
                }
                $outcome->delete();
            });
    }

    private function normalizeEditorText(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = preg_replace("/<p[^>]*>/i", '', $value);
        $normalized = preg_replace("/<\/p>/i", "\n", (string) $normalized);
        $normalized = preg_replace("/<br\s*\/?>/i", "\n", (string) $normalized);
        $normalized = str_replace('&nbsp;', ' ', (string) $normalized);
        $normalized = strip_tags((string) $normalized);
        $normalized = preg_replace("/\n{3,}/", "\n\n", (string) $normalized);
        $normalized = trim((string) $normalized);

        return $normalized === '' ? null : $normalized;
    }
}
