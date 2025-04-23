<?php

namespace App\Livewire;

use App\Actions\CreateEditorTokenAction;
use App\Enums\EditorTokenIcons;
use App\Enums\EditorTokenTypes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class EditorTokenForm extends Component
{
    public string $icon = '';

    public string $type = '';

    public string $name = '';

    public bool $hasGlobalValue = true;

    public function save(): void
    {
        $this->validate([
            'icon' => 'required|string',
            'type' => 'required|string',
            'name' => 'required|string|max:255',
        ]);

        /**
         * @var User $user
         */
        $user = Auth::user();

        (new CreateEditorTokenAction)->execute([
            'icon' => $this->icon,
            'type' => $this->type,
            'name' => $this->name,
            'hasGlobalValue' => $this->hasGlobalValue,
            'data' => [],
        ], $user);

        $this->dispatch('editor-token-created');
    }

    public function render(): View
    {
        return view('livewire.editor-token-form', [
            'icons' => EditorTokenIcons::cases(),
            'types' => EditorTokenTypes::cases(),
        ]);
    }
}
