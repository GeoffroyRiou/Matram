<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\EditorToken;
use App\Models\User;

class CreateEditorTokenAction
{
    /**
     * Create a new editor token.
     *
     * @param  array{name: string, type: string, icon: string, hasGlobalValue: bool}  $data
     * @return EditorToken<array<string, array<string, mixed>>>
     */
    public function execute(array $data, User $user): EditorToken
    {
        return EditorToken::create([
            ...$data,
            'user_id' => $user->id,
        ]);
    }
}
