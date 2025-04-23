<?php

describe('Editor token model', function () {

    it('has a valid toArray() return', function () {
        $user = \App\Models\User::factory()->create();
        $token = \App\Models\EditorToken::create([
            'user_id' => $user->id,
            'name' => 'Test Token',
            'icon' => 'test-icon',
            'type' => 'test-type',
            'hasGlobalValue' => true,
            'data' => ['key' => 'value'],
        ]);

        $this->assertEquals([
            'id' => $token->id,
            'user_id' => $user->id,
            'name' => 'Test Token',
            'icon' => 'test-icon',
            'type' => 'test-type',
            'hasGlobalValue' => true,
            'data' => ['key' => 'value'],
            'created_at' => $token->created_at->toIso8601ZuluString('microseconds'),
            'updated_at' => $token->updated_at->toIso8601ZuluString('microseconds'),
        ], $token->toArray());
    });
});
