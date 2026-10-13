<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Two sites from the same template, so the network has something to show
     * on a fresh checkout. Yes, this is copy-pasted twice — it was supposed to
     * become a proper command "later".
     */
    public function run(): void
    {
        // --- androidpixels.localhost -------------------------------------
        $meta = json_decode(File::get(base_path('templates/android-guide/site.json')), true);

        $site = Site::create([
            'domain' => 'androidpixels.localhost',
            'name' => $meta['name'],
            'tagline' => $meta['tagline'],
            'theme' => $meta['theme'],
            'locale' => $meta['locale'],
        ]);

        $categories = [];
        foreach ($meta['categories'] as $i => $cat) {
            $categories[$cat['slug']] = Category::create([
                'site_id' => $site->id,
                'slug' => $cat['slug'],
                'name' => $cat['name'],
                'lede' => $cat['lede'],
                'scene' => $cat['scene'],
                'sort' => $i,
            ]);
        }

        foreach (File::files(base_path('templates/android-guide/articles')) as $file) {
            $a = json_decode(File::get($file->getPathname()), true);

            Article::create([
                'site_id' => $site->id,
                'category_id' => $categories[$a['category']]->id,
                'slug' => $a['slug'],
                'title' => $a['title'],
                'description' => $a['description'],
                'summary' => $a['summary'],
                'body' => $a['body'],
                'reading_minutes' => $a['reading_minutes'],
                'published_at' => $a['published_at'],
                // The installer piece is still being fact-checked.
                'status' => $a['slug'] === 'installer' ? 'draft' : 'published',
            ]);
        }

        // --- gplaytips.localhost -----------------------------------------
        $meta = json_decode(File::get(base_path('templates/play-help/site.json')), true);

        $site = Site::create([
            'domain' => 'gplaytips.localhost',
            'name' => $meta['name'],
            'tagline' => $meta['tagline'],
            'theme' => $meta['theme'],
            'locale' => $meta['locale'],
        ]);

        $categories = [];
        foreach ($meta['categories'] as $i => $cat) {
            $categories[$cat['slug']] = Category::create([
                'site_id' => $site->id,
                'slug' => $cat['slug'],
                'name' => $cat['name'],
                'lede' => $cat['lede'],
                'scene' => $cat['scene'],
                'sort' => $i,
            ]);
        }

        foreach (File::files(base_path('templates/play-help/articles')) as $file) {
            $a = json_decode(File::get($file->getPathname()), true);

            Article::create([
                'site_id' => $site->id,
                'category_id' => $categories[$a['category']]->id,
                'slug' => $a['slug'],
                'title' => $a['title'],
                'description' => $a['description'],
                'summary' => $a['summary'],
                'body' => $a['body'],
                'reading_minutes' => $a['reading_minutes'],
                'published_at' => $a['published_at'],
                'status' => 'published',
            ]);
        }
    }
}
