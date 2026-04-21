<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ServiceProductSolution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['content', 'media', 'details', 'solutions'])->latest()->get();
        $contents = Content::orderBy('heading')->get();

        return view('admin.service.index', compact('services', 'contents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'content_id' => ['nullable', 'exists:contents,id'],
            'slug' => ['required', 'string', 'max:255', 'unique:services,slug'],
            'service_name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
            'overview' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ]);

        $service = Service::create([
            'content_id' => $validated['content_id'] ?? null,
            'slug' => $validated['slug'],
            'service_name' => $validated['service_name'],
            'overview' => $this->normalizeEditorText($validated['overview'] ?? null),
            'sort_order' => $validated['sort_order'] ?? 0,
            'active' => $request->boolean('active', true),
        ]);

        if ($request->hasFile('image')) {
            $service->addMedia($request->file('image'))->toMediaCollection('image');
        }

        if ($request->hasFile('icon')) {
            $service->addMedia($request->file('icon'))->toMediaCollection('icon');
        }

        return redirect()
            ->route('admin.services.edit', $service)
            ->with([
                'message' => 'Service created successfully',
                'alert-type' => 'success',
            ]);
    }

    public function edit(Service $service)
    {
        $service->load(['content', 'media', 'details.media', 'solutions']);
        $services = Service::with(['content', 'media'])->latest()->get();
        $contents = Content::orderBy('heading')->get();

        return view('admin.service.edit', compact('service', 'services', 'contents'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'content_id' => ['nullable', 'exists:contents,id'],
            'slug' => ['required', 'string', 'max:255', 'unique:services,slug,' . $service->id],
            'service_name' => ['required', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
            'overview' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'details' => ['nullable', 'array'],
            'details.*.id' => ['nullable', 'integer'],
            'details.*.text' => ['nullable', 'string'],
            'details.*.media_key' => ['nullable', 'string', 'max:50'],
            'details_icons' => ['nullable', 'array'],
            'details_icons.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'solutions' => ['nullable', 'array'],
            'solutions.*.id' => ['nullable', 'integer'],
            'solutions.*.heading' => ['nullable', 'string', 'max:255'],
            'solutions.*.sub_heading' => ['nullable', 'string', 'max:255'],
        ]);

        $service->fill([
            'content_id' => $validated['content_id'] ?? null,
            'slug' => $validated['slug'],
            'service_name' => $validated['service_name'],
            'overview' => $this->normalizeEditorText($validated['overview'] ?? null),
            'sort_order' => $validated['sort_order'] ?? 0,
            'active' => $request->boolean('active', true),
        ]);
        $service->save();

        if ($request->hasFile('image')) {
            $service->clearMediaCollection('image');
            $service->addMedia($request->file('image'))->toMediaCollection('image');
        }

        if ($request->hasFile('icon')) {
            $service->clearMediaCollection('icon');
            $service->addMedia($request->file('icon'))->toMediaCollection('icon');
        }

        $this->syncDetails($service, $request->input('details', []), $request->file('details_icons', []));
        $this->syncSolutions($service, $request->input('solutions', []));

        return redirect()
            ->route('admin.services.edit', $service)
            ->with([
                'message' => 'Service updated successfully',
                'alert-type' => 'success',
            ]);
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->load('details');

        foreach ($service->details as $detail) {
            $detail->clearMediaCollection('icon');
            $detail->delete();
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

    private function syncDetails(Service $service, array $details, array $detailIcons): void
    {
        $keptIds = [];

        foreach (array_values($details) as $index => $item) {
            $text = $this->normalizeEditorText($item['text'] ?? null) ?? '';
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

    private function syncSolutions(Service $service, array $solutions): void
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
        }

        $service->solutions()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each->delete();
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