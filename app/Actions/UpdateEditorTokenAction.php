<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\EditorToken;

class UpdateEditorTokenAction
{
    /**
     * Update an editor token.
     *
     * @param  array{name: string, type: string, icon: string, hasGlobalValue: bool, data: array<string, array<string, mixed>>}  $data
     * @return EditorToken
     */
    public function execute(EditorToken $editorToken, array $data): EditorToken
    {
        $editorToken->update($data);

        return $editorToken;
    }
}
