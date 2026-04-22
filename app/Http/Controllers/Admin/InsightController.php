<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insight;
use App\Models\InsightArticle;
use App\Models\Team;
use App\Models\InsightType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InsightController extends Controller
{
    public function index()
    {
        $insights = Insight::with(['articles.author', 'articles.media', 'media', 'insightType'])
            ->orderBy('sort_order')
            ->latest('id')
            ->get();

        $insightTypes = InsightType::orderBy('type')->where('status', true)->get(['id', 'type', 'status']);

        $teams = Team::query()->orderBy('first_name')->orderBy('last_name')->get(['id', 'first_name', 'last_name']);

        return view('admin.insight.index', compact('insights', 'insightTypes', 'teams'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateInsightRequest($request);

        dd($request->all(), $validated);
        
        $insight = Insight::create([
            'type' => $validated['type'],
            'heading' => $validated['heading'],
            'sub_heading' => $validated['sub_heading'] ?? null,
            'description' => $this->normalizeEditorText($validated['description'] ?? null),
            'sort_order' => $validated['sort_order'] ?? 0,
            'active' => (bool) ($validated['active'] ?? true),
            'published_at' => $validated['published_at'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            $insight->addMedia($request->file('image'))->toMediaCollection('image');
        }

        if ($request->hasFile('attachment')) {
            $insight->addMedia($request->file('attachment'))->toMediaCollection('attachment');
        }

        $this->syncArticles(
            $insight,
            $validated['articles'] ?? [],
            $request->file('article_icons', []),
            $request->file('article_attachments', [])
        );

        return redirect()
            ->route('admin.insights.edit', $insight)
            ->with([
                'message' => 'Insight created successfully',
                'alert-type' => 'success',
            ]);
    }

    public function edit(Insight $insight)
    {
        $insight->load(['articles.author', 'articles.media', 'media']);

        $insights = Insight::with(['articles', 'insightType'])
            ->orderBy('sort_order')
            ->latest('id')
            ->get();
        $insightTypes = InsightType::orderBy('type')->where('status', true)->get(['id', 'type', 'status']);
        $teams = Team::query()->orderBy('first_name')->orderBy('last_name')->get(['id', 'first_name', 'last_name']);

        return view('admin.insight.edit', compact('insight', 'insights', 'teams', 'insightTypes'));
    }

    public function update(Request $request, Insight $insight): RedirectResponse
    {
        $validated = $this->validateInsightRequest($request, true);

        $insight->fill([
            'type' => $validated['type'],
            'heading' => $validated['heading'],
            'sub_heading' => $validated['sub_heading'] ?? null,
            'description' => $this->normalizeEditorText($validated['description'] ?? null),
            'sort_order' => $validated['sort_order'] ?? 0,
            'active' => (bool) ($validated['active'] ?? false),
            'published_at' => $validated['published_at'] ?? null,
        ]);
        $insight->save();

        if ($request->boolean('remove_image')) {
            $insight->clearMediaCollection('image');
        }

        if ($request->boolean('remove_attachment')) {
            $insight->clearMediaCollection('attachment');
        }

        if ($request->hasFile('image')) {
            $insight->clearMediaCollection('image');
            $insight->addMedia($request->file('image'))->toMediaCollection('image');
        }

        if ($request->hasFile('attachment')) {
            $insight->clearMediaCollection('attachment');
            $insight->addMedia($request->file('attachment'))->toMediaCollection('attachment');
        }

        $this->syncArticles(
            $insight,
            $validated['articles'] ?? [],
            $request->file('article_icons', []),
            $request->file('article_attachments', [])
        );

        return redirect()
            ->route('admin.insights.edit', $insight)
            ->with([
                'message' => 'Insight updated successfully',
                'alert-type' => 'success',
            ]);
    }

    public function destroy(Insight $insight): RedirectResponse
    {
        $insight->load(['articles.media', 'media']);

        $insight->articles->each(function (InsightArticle $article) {
            $article->clearMediaCollection('icon');
            $article->clearMediaCollection('attachment');
            $article->delete();
        });

        $insight->clearMediaCollection('image');
        $insight->clearMediaCollection('attachment');
        $insight->delete();

        return redirect()
            ->route('admin.insights.index')
            ->with([
                'message' => 'Insight deleted successfully',
                'alert-type' => 'success',
            ]);
    }

    private function validateInsightRequest(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            'type' => ['required', 'string', 'in:download,read,video_watch'],
            'heading' => ['required', 'string', 'max:255'],
            'sub_heading' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg,pdf,mp4,mov,webm,avi,doc,docx,ppt,pptx,xlsx,xls', 'max:30720'],
            'remove_image' => ['nullable', 'boolean'],
            'remove_attachment' => ['nullable', 'boolean'],
            'articles' => ['nullable', 'array'],
            'articles.*.id' => ['nullable', 'integer'],
            'articles.*.author_team_id' => ['nullable', 'integer', 'exists:teams,id'],
            'articles.*.type' => ['nullable', 'string', 'in:download,read,video_watch'],
            'articles.*.title' => ['nullable', 'string', 'max:255'],
            'articles.*.description' => ['nullable', 'string'],
            'articles.*.read_minutes' => ['nullable', 'integer', 'min:1', 'max:999'],
            'articles.*.published_at' => ['nullable', 'date'],
            'article_icons' => ['nullable', 'array'],
            'article_icons.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'article_attachments' => ['nullable', 'array'],
            'article_attachments.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg,pdf,mp4,mov,webm,avi,doc,docx,ppt,pptx,xlsx,xls', 'max:30720'],
        ]);
    }

    private function syncArticles(Insight $insight, array $rows, array $icons, array $attachments): void
    {
        $keptIds = [];

        foreach (array_values($rows) as $index => $item) {
            $rowId = ! empty($item['id']) ? (int) $item['id'] : null;
            $title = trim((string) ($item['title'] ?? ''));
            $description = $this->normalizeEditorText($item['description'] ?? null) ?? '';
            $type = trim((string) ($item['type'] ?? 'read'));
            $authorId = ! empty($item['author_team_id']) ? (int) $item['author_team_id'] : null;
            $readMinutes = ! empty($item['read_minutes']) ? (int) $item['read_minutes'] : null;
            $publishedAt = $item['published_at'] ?? null;
            $icon = $icons[$index] ?? null;
            $attachment = $attachments[$index] ?? null;

            if ($title === '' && $description === '' && ! $icon && ! $attachment && $rowId === null) {
                continue;
            }

            $record = $rowId
                ? InsightArticle::firstOrNew(['id' => $rowId, 'insight_id' => $insight->id])
                : new InsightArticle(['insight_id' => $insight->id]);

            $record->insight_id = $insight->id;
            $record->author_team_id = $authorId;
            $record->type = in_array($type, ['download', 'read', 'video_watch'], true) ? $type : 'read';
            $record->title = $title;
            $record->description = $description;
            $record->sort_order = $index;
            $record->read_minutes = $readMinutes;
            $record->published_at = $publishedAt;
            $record->active = true;
            $record->save();

            if ($icon) {
                $record->clearMediaCollection('icon');
                $record->addMedia($icon)->toMediaCollection('icon');
            }

            if ($attachment) {
                $record->clearMediaCollection('attachment');
                $record->addMedia($attachment)->toMediaCollection('attachment');
            }

            $keptIds[] = $record->id;
        }

        $query = $insight->articles();

        if (! empty($keptIds)) {
            $query->whereNotIn('id', $keptIds);
        }

        $query->get()->each(function (InsightArticle $article) {
            $article->clearMediaCollection('icon');
            $article->clearMediaCollection('attachment');
            $article->delete();
        });
    }

    private function normalizeEditorText(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = preg_replace('/<p[^>]*>/i', '', $value);
        $normalized = preg_replace('/<\/p>/i', "\n\n", (string) $normalized);
        $normalized = preg_replace('/<br\s*\/?\s*>/i', "\n", (string) $normalized);
        $normalized = html_entity_decode(strip_tags((string) $normalized));
        $normalized = preg_replace('/\n{3,}/', "\n\n", (string) $normalized);

        return trim((string) $normalized);
    }
}
