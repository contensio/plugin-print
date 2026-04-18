<?php

/**
 * Print Button — Contensio plugin.
 * https://contensio.com
 *
 * @copyright   Copyright (c) 2026 Iosif Gabriel Chimilevschi
 * @license     https://www.gnu.org/licenses/agpl-3.0.txt  AGPL-3.0-or-later
 */

namespace Contensio\Plugins\PrintButton;

use Contensio\Models\Content;
use Contensio\Models\ContentTranslation;
use Contensio\Support\Hook;
use Illuminate\Support\ServiceProvider;

class PrintButtonServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'print-button');

        // Print-specific CSS rules injected into <head> (only active when printing)
        Hook::add('contensio/frontend/head', function (): string {
            return view('print-button::partials.print-css')->render();
        });

        // Print button injected into the post meta row at priority 20
        Hook::add('contensio/frontend/post-meta', function (Content $content, ContentTranslation $translation): string {
            return '<span>&middot;</span>'
                . '<button type="button" onclick="window.print()" '
                . 'class="inline-flex items-center gap-1 hover:text-gray-700 transition-colors">'
                . '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">'
                . '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>'
                . '</svg>Print</button>';
        }, 20);
    }
}
