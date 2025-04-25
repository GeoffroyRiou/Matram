<?php

namespace App\Livewire;

use App\Models\EditorToken;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class EditorTokensList extends Component
{
    /**
     * The available tokens for the authenticated user.
     *
     * @var Collection<int,EditorToken>
     */
    public ?Collection $availableTokens = null;

    public function mount(): void
    {
        $this->retrieveAvailableTokens();
    }

    private function retrieveAvailableTokens(): void
    {
        /** @var User $authUser */
        $authUser =  Auth::user();
        $availableTokens = $authUser->tokens;
        $this->availableTokens = $availableTokens;
    }
    public function render(): View
    {
        return view('livewire.editor-tokens-list');
    }
}
