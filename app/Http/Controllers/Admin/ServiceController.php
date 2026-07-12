<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ServiceHeroPillar;
use App\Models\ServiceProductSolution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['media', 'details', 'solutions'])->latest()->get();

        return view('admin.service.index', compact('services'));
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slug'                => ['required', 'string', 'max:255', 'unique:services,slug'],
            'service_name'        => ['required', 'string', 'max:255'],
            'section'             => ['nullable', 'string', 'max:255'],
            'heading'             => ['nullable', 'string', 'max:255'],
            'design_word'         => ['nullable', 'string', 'max:255'],
            'description'         => ['nullable', 'string'],
            'sort_order'          => ['nullable', 'integer', 'min:0'],
            'active'              => ['nullable', 'boolean'],
            'overview'            => ['nullable', 'string'],
            'remove_image'        => ['nullable', 'boolean'],
            'image'               => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'icon'                => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'details'             => ['nullable', 'array'],
            'details.*.id'        => ['nullable', 'integer'],
            'details.*.text'      => ['nullable', 'string'],
            'details_icons'       => ['nullable', 'array'],
            'details_icons.*'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'solutions'               => ['nullable', 'array'],
            'solutions.*.id'          => ['nullable', 'integer'],
            'solutions.*.heading'     => ['nullable', 'string', 'max:255'],
            'solutions.*.sub_heading' => ['nullable', 'string', 'max:255'],
            'solutions_icons'         => ['nullable', 'array'],
            'solutions_icons.*'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'hero_pillars'              => ['nullable', 'array'],
            'hero_pillars.*.id'         => ['nullable', 'integer'],
            'hero_pillars.*.title'      => ['nullable', 'string', 'max:255'],
            'hero_pillars.*.description'=> ['nullable', 'string'],
            'hero_pillars_icons'        => ['nullable', 'array'],
            'hero_pillars_icons.*'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);

        $service = Service::create([
            'slug'         => $validated['slug'],
            'service_name' => $validated['service_name'],
            'section'      => $validated['section'] ?? null,
            'heading'      => $validated['heading'] ?? null,
            'design_word'  => $validated['design_word'] ?? null,
            'description'  => $validated['description'] ?? null,
            'overview'     => $validated['overview'] ?? null,
            'sort_order'   => $validated['sort_order'] ?? 0,
            'active'       => $request->boolean('active', true),
        ]);

        if ($request->hasFile('image')) {
            $service->addMedia($request->file('image'))->toMediaCollection('image');
        }

        if ($request->hasFile('icon')) {
            $service->addMedia($request->file('icon'))->toMediaCollection('icon');
        }

        $this->syncDetails($service, $request->input('details', []), $request->file('details_icons', []));
        $this->syncSolutions($service, $request->input('solutions', []), $request->file('solutions_icons', []));
        $this->syncHeroPillars($service, $request->input('hero_pillars', []), $request->file('hero_pillars_icons', []));

        return redirect()
            ->route('admin.services.index')
            ->with([
                'message' => 'Service created successfully',
                'alert-type' => 'success',
            ]);
    }

    public function edit(Service $service)
    {
        $service->load(['media', 'details.media', 'solutions.media', 'heroPillars.media']);
        $services = Service::with(['media'])->latest()->get();

        return view('admin.service.edit', compact('service', 'services'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'slug'                => ['required', 'string', 'max:255', 'unique:services,slug,' . $service->id],
            'service_name'        => ['required', 'string', 'max:255'],
            'section'             => ['nullable', 'string', 'max:255'],
            'heading'             => ['nullable', 'string', 'max:255'],
            'design_word'         => ['nullable', 'string', 'max:255'],
            'description'         => ['nullable', 'string'],
            'sort_order'          => ['nullable', 'integer', 'min:0'],
            'active'              => ['nullable', 'boolean'],
            'overview'            => ['nullable', 'string'],
            'remove_image'        => ['nullable', 'boolean'],
            'image'               => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'icon'                => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'details'             => ['nullable', 'array'],
            'details.*.id'        => ['nullable', 'integer'],
            'details.*.text'      => ['nullable', 'string'],
            'details.*.media_key' => ['nullable', 'string', 'max:50'],
            'details_icons'       => ['nullable', 'array'],
            'details_icons.*'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'solutions'               => ['nullable', 'array'],
            'solutions.*.id'          => ['nullable', 'integer'],
            'solutions.*.heading'     => ['nullable', 'string', 'max:255'],
            'solutions.*.sub_heading' => ['nullable', 'string', 'max:255'],
            'solutions_icons'         => ['nullable', 'array'],
            'solutions_icons.*'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'hero_pillars'              => ['nullable', 'array'],
            'hero_pillars.*.id'         => ['nullable', 'integer'],
            'hero_pillars.*.title'      => ['nullable', 'string', 'max:255'],
            'hero_pillars.*.description'=> ['nullable', 'string'],
            'hero_pillars_icons'        => ['nullable', 'array'],
            'hero_pillars_icons.*'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);

        $service->fill([
            'slug'         => $validated['slug'],
            'service_name' => $validated['service_name'],
            'section'      => $validated['section'] ?? null,
            'heading'      => $validated['heading'] ?? null,
            'design_word'  => $validated['design_word'] ?? null,
            'description'  => $validated['description'] ?? null,
            'overview'     => $validated['overview'] ?? null,
            'sort_order'   => $validated['sort_order'] ?? 0,
            'active'       => $request->boolean('active', true),
        ]);
        $service->save();

        if ($request->boolean('remove_image')) {
            $service->clearMediaCollection('image');
        }

        if ($request->hasFile('image')) {
            $service->clearMediaCollection('image');
            $service->addMedia($request->file('image'))->toMediaCollection('image');
        }

        if ($request->hasFile('icon')) {
            $service->clearMediaCollection('icon');
            $service->addMedia($request->file('icon'))->toMediaCollection('icon');
        }

        $this->syncDetails($service, $request->input('details', []), $request->file('details_icons', []));
        $this->syncSolutions($service, $request->input('solutions', []), $request->file('solutions_icons', []));
        $this->syncHeroPillars($service, $request->input('hero_pillars', []), $request->file('hero_pillars_icons', []));

        return redirect()
            ->route('admin.services.index')
            ->with([
                'message' => 'Service updated successfully',
                'alert-type' => 'success',
            ]);
    }

    public function updateSortOrder(Request $request, Service $service)
    {
        $request->validate(['sort_order' => 'required|integer|min:0']);
        $service->update(['sort_order' => $request->sort_order]);
        return response()->json(['success' => true]);
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->load(['details', 'solutions', 'heroPillars']);

        foreach ($service->details as $detail) {
            $detail->clearMediaCollection('icon');
            $detail->delete();
        }

        foreach ($service->solutions as $solution) {
            $solution->clearMediaCollection('icon');
            $solution->delete();
        }

        foreach ($service->heroPillars as $pillar) {
            $pillar->clearMediaCollection('icon');
            $pillar->delete();
        }

        $service->clearMediaCollection('image');
        $service->clearMediaCollection('icon');
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with([
                'message' => 'Service deleted successfully',
                'alert-type' => 'success',
            ]);
    }

    private function syncHeroPillars(Service $service, array $pillars, array $pillarIcons = []): void
    {
        $keptIds = [];

        foreach (array_values($pillars) as $index => $item) {
            $title       = trim((string) ($item['title'] ?? ''));
            $description = trim((string) ($item['description'] ?? ''));
            $pillarId    = ! empty($item['id']) ? (int) $item['id'] : null;

            if ($title === '' && $description === '' && $pillarId === null) {
                continue;
            }

            $pillar = $pillarId
                ? ServiceHeroPillar::firstOrNew(['id' => $pillarId, 'service_id' => $service->id])
                : new ServiceHeroPillar(['service_id' => $service->id]);

            $pillar->service_id  = $service->id;
            $pillar->title       = $title;
            $pillar->description = $description ?: null;
            $pillar->sort_order  = $index;
            $pillar->save();

            $keptIds[] = $pillar->id;

            if (isset($pillarIcons[$index])) {
                $pillar->clearMediaCollection('icon');
                $pillar->addMedia($pillarIcons[$index])->toMediaCollection('icon');
            }
        }

        $service->heroPillars()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each(function (ServiceHeroPillar $pillar) {
                $pillar->clearMediaCollection('icon');
                $pillar->delete();
            });
    }

    private function syncDetails(Service $service, array $details, array $detailIcons): void
    {
        $keptIds = [];

        foreach (array_values($details) as $index => $item) {
            $text = $item['text'] ?? null;
            $detailId = ! empty($item['id']) ? (int) $item['id'] : null;

            if ($text === '' && ! isset($detailIcons[$index]) && $detailId === null) {
                continue;
            }

            $detail = $detailId ? ServiceDetail::firstOrNew(['id' => $detailId, 'service_id' => $service->id]) : new ServiceDetail(['service_id' => $service->id]);
            $detail->service_id = $service->id;
            $detail->setAttribute('text', $text);
            $detail->sort_order = $index;
            $detail->save();

            $keptIds[] = $detail->id;

            if (isset($detailIcons[$index])) {
                $detail->clearMediaCollection('icon');
                $detail->addMedia($detailIcons[$index])->toMediaCollection('icon');
            }
        }

        $service->details()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each(function (ServiceDetail $detail) {
                $detail->clearMediaCollection('icon');
                $detail->delete();
            });
    }

    private function syncSolutions(Service $service, array $solutions, array $solutionIcons = []): void
    {
        $keptIds = [];

        foreach (array_values($solutions) as $index => $item) {
            $heading = trim((string) ($item['heading'] ?? ''));
            $subHeading = trim((string) ($item['sub_heading'] ?? ''));
            $solutionId = ! empty($item['id']) ? (int) $item['id'] : null;

            if ($heading === '' && $subHeading === '' && $solutionId === null) {
                continue;
            }

            $solution = $solutionId
                ? ServiceProductSolution::firstOrNew(['id' => $solutionId, 'service_id' => $service->id])
                : new ServiceProductSolution(['service_id' => $service->id]);

            $solution->service_id = $service->id;
            $solution->heading = $heading;
            $solution->sub_heading = $subHeading;
            $solution->sort_order = $index;
            $solution->save();

            $keptIds[] = $solution->id;

            if (isset($solutionIcons[$index])) {
                $solution->clearMediaCollection('icon');
                $solution->addMedia($solutionIcons[$index])->toMediaCollection('icon');
            }
        }

        $service->solutions()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each(function (ServiceProductSolution $solution) {
                $solution->clearMediaCollection('icon');
                $solution->delete();
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