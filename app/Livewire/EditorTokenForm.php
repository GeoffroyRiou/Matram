<?php

namespace App\Livewire;

use App\Actions\CreateEditorTokenAction;
use App\Actions\UpdateEditorTokenAction;
use App\Enums\EditorTokenIcons;
use App\Enums\EditorTokenTypes;
use App\Models\EditorToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class EditorTokenForm extends Component
{
    public ?int $editorTokenId = null;

    public string $icon = '';

    public string $type = '';

    public string $name = '';

    public bool $hasGlobalValue = true;

    /**
     * @var array<string, mixed>
     */
    public array $data = [];

    public function mount(?int $editorTokenId = null): void
    {
        if (! $editorTokenId) {
            return;
        }

        $editorToken = EditorToken::findOrFail($editorTokenId);
        $this->editorTokenId = $editorTokenId;

        $this->icon = $editorToken->icon;
        $this->type = $editorToken->type;
        $this->name = $editorToken->name;
        $this->hasGlobalValue = $editorToken->hasGlobalValue;
        $this->data = $editorToken->data;
    }

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

        if (! empty($this->editorTokenId)) {
            $editorToken = EditorToken::findOrFail($this->editorTokenId);
            (new UpdateEditorTokenAction)->execute($editorToken, [
                'icon' => $this->icon,
                'type' => $this->type,
                'name' => $this->name,
                'hasGlobalValue' => $this->hasGlobalValue,
                'data' => [],
            ]);
        } else {
            (new CreateEditorTokenAction)->execute([
                'icon' => $this->icon,
                'type' => $this->type,
                'name' => $this->name,
                'hasGlobalValue' => $this->hasGlobalValue,
                'data' => [],
            ], $user);

            $this->dispatch('editor-token-created');
        }
    }

    public function render(): View
    {
        return view('livewire.editor-token-form', [
            'icons' => EditorTokenIcons::cases(),
            'types' => EditorTokenTypes::cases(),
        ]);
    }
}
