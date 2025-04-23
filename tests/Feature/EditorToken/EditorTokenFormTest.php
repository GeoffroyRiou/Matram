<?php

declare(strict_types=1);

use App\Livewire\EditorTokenForm;
use App\Models\User;
use Livewire\Livewire;

describe('EditorToken form', function () {
    it('renders', function () {
        Livewire::test(EditorTokenForm::class)
            ->assertStatus(200);
    });

    it('fails validation', function () {
        Livewire::test(EditorTokenForm::class)
            ->set('icon', '')
            ->set('type', '')
            ->set('name', '')
            ->set('hasGlobalValue', false)
            ->call('save')
            ->assertHasErrors([
                'icon' => 'required',
                'type' => 'required',
                'name' => 'required',
            ]);
    });

    it('can create a new editor token', function () {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(EditorTokenForm::class)
            ->set('icon', 'icon')
            ->set('type', 'type')
            ->set('name', 'name')
            ->set('hasGlobalValue', false)
            ->call('save')
            ->assertHasNoErrors()
            ->assertDispatched('editor-token-created');

        $this->assertDatabaseHas('editor_tokens', [
            'icon' => 'icon',
            'type' => 'type',
            'name' => 'name',
            'user_id' => $user->id,
            'hasGlobalValue' => false,
        ]);

    });
    
})->only();
