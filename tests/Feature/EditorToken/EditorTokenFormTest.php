<?php

declare(strict_types=1);

use App\Livewire\EditorTokenForm;
use App\Models\EditorToken;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    it('throw a ModelNotFoundException when a unknow editor token id is passed as parameter', function () {
        $user = User::factory()->create();

        expect(fn () => Livewire::actingAs($user)
            ->test(EditorTokenForm::class, ['editorTokenId' => 999])
        )
            ->toThrow(ModelNotFoundException::class);

    });

    it('correctly fills form when an editor token id is passed. And saves correct values at update', function () {
        $user = User::factory()->create();
        $editorToken = EditorToken::create([
            'user_id' => $user->id,
            'icon' => 'icon',
            'type' => 'type',
            'name' => 'name',
            'hasGlobalValue' => false,
            'data' => [],
        ]);

        Livewire::actingAs($user)
            ->test(EditorTokenForm::class, ['editorTokenId' => $editorToken->id])
            ->assertSet('icon', 'icon')
            ->assertSet('type', 'type')
            ->assertSet('name', 'name')
            ->assertSet('hasGlobalValue', false)
            ->set('icon', 'newIcon')
            ->set('type', 'newType')
            ->set('name', 'newName')
            ->set('hasGlobalValue', true)
            ->call('save');

        $editorToken->refresh();
        $this->assertDatabaseHas('editor_tokens', [
            'icon' => 'newIcon',
            'type' => 'newType',
            'name' => 'newName',
            'user_id' => $user->id,
            'hasGlobalValue' => true,
        ]);
        $this->assertDatabaseMissing('editor_tokens', [
            'icon' => 'icon',
            'type' => 'type',
            'name' => 'name',
            'user_id' => $user->id,
            'hasGlobalValue' => false,
        ]);

    });

})->only();
