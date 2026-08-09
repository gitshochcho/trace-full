<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MinifyFrontendAssets extends Command
{
    protected $signature = 'assets:minify';

    protected $description = 'Minify the hand-written frontend/css/style.css and frontend/js/script.js into .min versions';

    protected array $files = [
        ['src' => 'frontend/css/style.css', 'min' => 'frontend/css/style.min.css', 'type' => 'css'],
        ['src' => 'frontend/js/script.js', 'min' => 'frontend/js/script.min.js', 'type' => 'js'],
    ];

    public function handle(): int
    {
        foreach ($this->files as $file) {
            $srcPath = public_path($file['src']);
            $minPath = public_path($file['min']);

            if (! file_exists($srcPath)) {
                $this->warn("Skipped (not found): {$file['src']}");
                continue;
            }

            $content = file_get_contents($srcPath);
            $minified = $file['type'] === 'css' ? $this->minifyCss($content) : $this->minifyJs($content);

            file_put_contents($minPath, $minified);

            $before = strlen($content);
            $after = strlen($minified);
            $saved = $before > 0 ? round((1 - $after / $before) * 100, 1) : 0;

            $this->info("{$file['src']} -> {$file['min']} ({$before}B -> {$after}B, -{$saved}%)");
        }

        return self::SUCCESS;
    }

    protected function minifyCss(string $css): string
    {
        // Strip comments
        $css = preg_replace('#/\*.*?\*/#s', '', $css);
        // Collapse whitespace
        $css = preg_replace('/\s+/', ' ', $css);
        // Remove space around symbols
        $css = preg_replace('/\s*([{}:;,])\s*/', '$1', $css);
        // Remove trailing semicolon before }
        $css = str_replace(';}', '}', $css);

        return trim($css);
    }

    protected function minifyJs(string $js): string
    {
        // Strip /* */ block comments
        $js = preg_replace('#/\*.*?\*/#s', '', $js);
        // Strip // line comments (naive: skips lines starting with // after trim, avoids touching URLs like http://)
        $js = preg_replace('#(^|\s)//(?!.*://).*$#m', '', $js);
        // Collapse blank lines and surrounding whitespace
        $lines = array_map('trim', explode("\n", $js));
        $lines = array_filter($lines, fn ($line) => $line !== '');

        return implode("\n", $lines);
    }
}
