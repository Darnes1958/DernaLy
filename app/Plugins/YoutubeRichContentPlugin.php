<?php

namespace App\Plugins;

use Filament\Forms\Components\RichEditor\Plugins\Contracts\RichContentPlugin;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Icons\Heroicon;
use Tiptap\Nodes\Youtube;


class YoutubeRichContentPlugin implements RichContentPlugin
{

    public static function make(): static
    {

        return app(static::class);
    }


    /**
     * @return array<string>
     */

    public function getTipTapJsExtensions(): array
{
    // This method should return an array of URLs to JavaScript files containing
    // TipTap extensions that should be asynchronously loaded into the editor
    // when the plugin is used.

    return [
        FilamentAsset::getScriptSrc('rich-content-plugins/youtube'),
    ];
}

    /**
     * @return array<RichEditorTool>
     */
    public function getEditorTools(): array
    {
        // This method should return an array of `RichEditorTool` objects, which can then be
        // used in the `toolbarButtons()` of the editor.

        // The `jsHandler()` method allows you to access the TipTap editor instance
        // through `$getEditor()`, and `chain()` any TipTap commands to it.
        // See: https://tiptap.dev/docs/editor/api/commands

        // The `action()` method allows you to run an action (registered in the `getEditorActions()`
        // method) when the toolbar button is clicked. This allows you to open a modal to
        // collect additional information from the user before running a command.

        return [
            RichEditorTool::make('youtube')
                ->action(arguments: '{ color: $getEditor().getAttributes(\'highlight\')?.[\'data-color\'] }')
                ->icon(Heroicon::CursorArrowRipple),

        ];
    }


    public function getTipTapPhpExtensions(): array
    {

        return [
            app(Youtube::class, [
                'options' => ['multicolor' => true],
            ]),
        ];
    }

    public function getEditorActions(): array
    {
        // TODO: Implement getEditorActions() method.
    }
}
