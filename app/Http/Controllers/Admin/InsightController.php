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
    // public function index()
    // {
    //     $insights = Insight::with(['articles.author', 'media', 'insightType'])->orderBy('sort_order')->latest('id')->get();
    //     $insightTypes = InsightType::orderBy('type')->where('status', true)->get(['id', 'type', 'status']);
    //     $teams = Team::query()->orderBy('first_name')->orderBy('last_name')->get(['id', 'first_name', 'last_name']);
    //     return view('admin.insight.index', compact('insights', 'insightTypes', 'teams'));
    // }

    public function index()
    {
        $insights = Insight::with(['articles', 'insightType'])
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(15);
        return view('admin.insight.index', compact('insights'));
    }

    public function create()
    {
        $insightTypes = InsightType::orderBy('type')->where('status', true)->get(['id', 'type', 'type_category', 'status']);
        $teams = Team::query()->orderBy('first_name')->orderBy('last_name')->get(['id', 'first_name', 'last_name']);
        $nextSortOrder = (Insight::max('sort_order') ?? -1) + 1;
        return view('admin.insight.create', compact('insightTypes', 'teams', 'nextSortOrder'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateInsightRequest($request);
        $authorTeamIds = array_values(array_filter(array_map('intval', $validated['author_team_ids'] ?? [])));
        $insight = Insight::create([
            'type' => $validated['type'],
            'video_link' => $validated['video_link'] ?? null,
            'heading' => $validated['heading'],
            'sub_heading' => $validated['sub_heading'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'active' => (bool) ($validated['active'] ?? true),
            'published_at' => $validated['published_at'] ?? null,
            'source_name' => $validated['source_name'] ?? null,
            'publish_links' => $validated['publish_links'] ?? [],
            'author_team_ids' => $authorTeamIds,
            'outside_authors' => $validated['outside_authors'] ?? [],
        ]);

        $this->handleInsightMedia($insight, $request);
        $this->syncArticles($insight, $validated['articles'] ?? [], [], [], $authorTeamIds[0] ?? null);

        return redirect()->route('admin.insights.index')->with(['message' => 'Insight created successfully', 'alert-type' => 'success']);
    }

    public function edit(Insight $insight)
    {
        $insight->load(['articles.author', 'media']);
        $insights = Insight::with(['articles', 'insightType'])->orderBy('sort_order')->latest('id')->get();
        $insightTypes = InsightType::orderBy('type')->where('status', true)->get(['id', 'type', 'type_category', 'status']);
        $teams = Team::query()->orderBy('first_name')->orderBy('last_name')->get(['id', 'first_name', 'last_name']);
        return view('admin.insight.edit', compact('insight', 'insights', 'teams', 'insightTypes'));
    }

    public function update(Request $request, Insight $insight): RedirectResponse
    {
        
        $validated = $this->validateInsightRequest($request, true);
        $authorTeamIds = array_values(array_filter(array_map('intval', $validated['author_team_ids'] ?? [])));
        $insight->fill([
            'type' => $validated['type'],
            'type_id' => $validated['type'],
            'heading' => $validated['heading'],
            'video_link' => $validated['video_link'] ?? $insight->video_link,
            'sub_heading' => $validated['sub_heading'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'active' => (bool) ($validated['active'] ?? true),
            'published_at' => $validated['published_at'] ?? null,
            'source_name' => $validated['source_name'] ?? null,
            'publish_links' => $validated['publish_links'] ?? [],
            'author_team_ids' => $authorTeamIds,
            'outside_authors' => $validated['outside_authors'] ?? [],
        ]);
        $insight->save();

        $this->handleInsightMedia($insight, $request, true);
        $this->syncArticles($insight, $validated['articles'] ?? [], [], [], $authorTeamIds[0] ?? null);

        return redirect()->route('admin.insights.index')->with(['message' => 'Insight updated successfully', 'alert-type' => 'success']);
    }

    public function destroy(Insight $insight): RedirectResponse
    {
        $insight->load(['articles.media', 'media']);
        $insight->articles->each(fn($a) => $a->clearMediaCollection('icon') || $a->clearMediaCollection('attachment') || $a->delete());
        $insight->clearMediaCollection('image')->clearMediaCollection('attachment')->clearMediaCollection('article_image')->clearMediaCollection('social_icons')->delete();
        return redirect()->route('admin.insights.index')->with(['message' => 'Insight deleted successfully', 'alert-type' => 'success']);
    }

      private function validateInsightRequest(Request $request, bool $isUpdate = false): array
    {
        return $request->validate([
            // Root Level
            'type' => ['required', 'integer', 'exists:insight_types,id'],
            'author_team_ids' => ['nullable', 'array'],
            'author_team_ids.*' => ['nullable', 'integer', 'exists:teams,id'],
            'outside_authors' => ['nullable', 'array'],
            'outside_authors.*.name' => ['nullable', 'string', 'max:255'],
            'outside_authors.*.description' => ['nullable', 'string'],
            'heading' => ['required', 'string', 'max:255'],
            'sub_heading' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'active' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
            'video_link' => ['nullable', 'url'],
            'remove_image' => ['nullable', 'boolean'],
            'remove_article_image' => ['nullable', 'boolean'],
            'remove_attachment' => ['nullable', 'boolean'],

            // Media
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:4096'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg,pdf,mp4,mov,webm,avi,doc,docx,ppt,pptx,xlsx,xls', 'max:30720'],
            'article_icons' => ['nullable', 'array'],
            'article_icons.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'article_attachments' => ['nullable', 'array'],
            'article_attachments.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg,pdf,mp4,mov,webm,avi,doc,docx,ppt,pptx,xlsx,xls', 'max:30720'],

            // ✅ Articles: EXACTLY what the form sends (No extra rules)
            'articles' => ['nullable', 'array'],
            'articles.*.id' => ['nullable', 'integer'],
            'articles.*.title' => ['nullable', 'string', 'max:255'], 
            'articles.*.description' => ['nullable', 'string'],

            'articles.*.image_description' => ['nullable', 'string', 'max:255'],
            'articles.*.social_links' => ['nullable',           'array'],                  
            'articles.*.social_links.*.name' => ['nullable',            'string'],           
            'articles.*.social_links.*.link' => ['nullable', 'string'], 
            'source_name' => ['nullable', 'string', 'max:255'],
            'publish_links' => ['nullable', 'array'],
            'publish_links.*.name' => ['nullable', 'string', 'max:255'],
            'publish_links.*.link' => ['nullable', 'string', 'max:500'],
        ]);
    }

    private function handleInsightMedia(Insight $insight, Request $request, bool $isUpdate = false): void
    {
        if ($isUpdate && $request->boolean('remove_image')) $insight->clearMediaCollection('image');
        if ($isUpdate && $request->boolean('remove_article_image')) $insight->clearMediaCollection('article_image');
        if ($isUpdate && $request->boolean('remove_attachment')) $insight->clearMediaCollection('attachment');
        // Remove attachment from the first article (when using article_attachments[0])
        if ($isUpdate && $request->boolean('remove_article_attachment')) {
            $firstArticle = $insight->articles()->first();
            if ($firstArticle) $firstArticle->clearMediaCollection('attachment');
        }

        if ($request->hasFile('image')) { $insight->clearMediaCollection('image'); $insight->addMedia($request->file('image'))->toMediaCollection('image'); }
        if ($request->hasFile('attachment')) { $insight->clearMediaCollection('attachment'); $insight->addMedia($request->file('attachment'))->toMediaCollection('attachment'); }
        if ($request->hasFile('article_image')) { $insight->clearMediaCollection('article_image'); $insight->addMedia($request->file('article_image'))->toMediaCollection('article_image'); }

        $insight->clearMediaCollection('social_icons');
        if ($request->hasFile('social_icon_files')) {
            foreach ($request->file('social_icon_files') as $icon) {
                $insight->addMedia($icon)->toMediaCollection('social_icons');
            }
        }
    }

    private function syncArticles(Insight $insight, array $rows, array $icons = [], array $attachments = [], ?int $authorTeamId = null): void
{
    $keptIds = [];
    $globalAuthorId = $authorTeamId;

    foreach (array_values($rows) as $index => $item) {
        $rowId = !empty($item['id']) ? (int) $item['id'] : null;
        $title = trim((string) ($item['title'] ?? ''));
        $description = $item['description'] ?? '';
        $icon = $icons[$index] ?? null;
      $attachment = request()->file("article_attachments.$index") ?? null;

        if ($title === '' && $description === '' && !$icon && !$attachment && $rowId === null) {
            continue;
        }

        $record = $rowId
            ? InsightArticle::firstOrNew(['id' => $rowId, 'insight_id' => $insight->id])
            : new InsightArticle(['insight_id' => $insight->id]);

        $record->insight_id = $insight->id;
        $record->author_team_id = $globalAuthorId;
        $record->title = $title;
        $record->description = $description;
        $record->sort_order = $index;
       $record->type = $insight->type;
       $record->active = true;
       $record->image_description = $item['image_description'] ?? null;
        $record->save();

        $record->social_links = $item['social_links'] ?? [];
        $record->save();

        if ($icon) { $record->clearMediaCollection('icon'); $record->addMedia($icon)->toMediaCollection('icon'); }
        if ($attachment) { $record->clearMediaCollection('attachment'); $record->addMedia($attachment)->toMediaCollection('attachment'); }

        $keptIds[] = $record->id;
    }

    $insight->articles()
        ->whereNotIn('id', array_filter($keptIds))
        ->get()
        ->each(function (InsightArticle $article) {
            $article->clearMediaCollection('icon');
            $article->clearMediaCollection('attachment');
            $article->delete();
        });
}

    private function isReadType(int $typeId): bool
    {
        if ($typeId <= 0) {
            return false;
        }

        $category = InsightType::query()
            ->whereKey($typeId)
            ->value('type_category');

        return strtolower((string) $category) === 'read';
    }

    private function normalizeEditorText(?string $value): ?string
    {
        if ($value === null) return null;
        $normalized = preg_replace('/<p[^>]*>/i', '', $value);
        $normalized = preg_replace('/<\/p>/i', "\n", (string) $normalized);
        $normalized = preg_replace('/<br\s*\/?\s*>/i', "\n", (string) $normalized);
        $normalized = html_entity_decode(strip_tags((string) $normalized));
        $normalized = preg_replace('/\n{3,}/', "\n", (string) $normalized);
        return trim((string) $normalized);
    }
}