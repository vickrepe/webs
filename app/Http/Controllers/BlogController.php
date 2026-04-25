<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    private function site(string $slug): Site
    {
        return Site::where('slug', $slug)->firstOrFail();
    }

    public function index(string $slug)
    {
        $site     = $this->site($slug);
        $posts    = $site->blogPosts()->where('published', true)->latest('published_at')->paginate(9);
        $template = config("templates.{$site->sector}");
        $sections = $site->sections()->where('active', true)->get()->keyBy('type');
        $viewName = "themes.{$site->sector}.blog.index";
        abort_unless(view()->exists($viewName), 404);

        return view($viewName, compact('site', 'posts', 'template', 'sections'));
    }

    public function show(string $slug, string $postSlug)
    {
        $site = $this->site($slug);
        $post = $site->blogPosts()->where('slug', $postSlug)->firstOrFail();

        $isOwner = auth()->check() && auth()->id() === $site->user_id;
        if (! $post->published && ! $isOwner) abort(404);

        $template = config("templates.{$site->sector}");
        $sections = $site->sections()->where('active', true)->get()->keyBy('type');
        $viewName = "themes.{$site->sector}.blog.show";
        abort_unless(view()->exists($viewName), 404);

        return view($viewName, compact('site', 'post', 'template', 'sections'));
    }

    public function store(Request $request, string $slug)
    {
        $site = $this->site($slug);
        abort_if(auth()->id() !== $site->user_id, 403);

        $limit = config("plans.{$site->plan}.blog_posts", 5);
        abort_if($site->blogPosts()->count() >= $limit, 403, 'Límite de posts alcanzado.');

        $post = $site->blogPosts()->create([
            'title'     => 'Nuevo artículo',
            'slug'      => $this->uniqueSlug($site, 'nuevo-articulo'),
            'content'   => '',
            'published' => false,
        ]);

        return redirect()->route('blog.show', [$slug, $post->slug]);
    }

    public function update(Request $request, string $slug, string $postSlug)
    {
        $site = $this->site($slug);
        $post = $site->blogPosts()->where('slug', $postSlug)->firstOrFail();
        abort_if(auth()->id() !== $site->user_id, 403);

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
            'excerpt' => 'nullable|string|max:500',
        ]);

        $newSlug = $post->slug;
        if ($request->title !== $post->title) {
            $newSlug = $this->uniqueSlug($site, Str::slug($request->title), $post->id);
        }

        $post->update([
            'title'   => $request->title,
            'slug'    => $newSlug,
            'content' => $request->content ?? '',
            'excerpt' => $request->excerpt,
        ]);

        return response()->json(['ok' => true, 'slug' => $newSlug]);
    }

    public function togglePublish(string $slug, string $postSlug)
    {
        $site = $this->site($slug);
        $post = $site->blogPosts()->where('slug', $postSlug)->firstOrFail();
        abort_if(auth()->id() !== $site->user_id, 403);

        $published = ! $post->published;
        $post->update([
            'published'    => $published,
            'published_at' => $published ? now() : null,
        ]);

        return response()->json(['ok' => true, 'published' => $published]);
    }

    public function destroy(string $slug, string $postSlug)
    {
        $site = $this->site($slug);
        $post = $site->blogPosts()->where('slug', $postSlug)->firstOrFail();
        abort_if(auth()->id() !== $site->user_id, 403);

        $post->delete();
        return redirect()->route('blog.index', $slug);
    }

    public function uploadCover(Request $request, string $slug, string $postSlug)
    {
        $site = $this->site($slug);
        $post = $site->blogPosts()->where('slug', $postSlug)->firstOrFail();
        abort_if(auth()->id() !== $site->user_id, 403);

        $request->validate(['cover' => ['required', 'image', 'max:4096']]);
        $path = $request->file('cover')->store("blogs/{$site->id}", 'public');
        $post->update(['cover_image' => '/storage/' . $path]);

        return response()->json(['ok' => true, 'url' => '/storage/' . $path]);
    }

    private function uniqueSlug(Site $site, string $base, ?int $excludeId = null): string
    {
        $slug = $base; $counter = 2;
        while ($site->blogPosts()->where('slug', $slug)->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }
        return $slug;
    }
}
