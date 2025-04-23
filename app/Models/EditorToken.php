<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @template TItem
 *
 * @property-read int $id
 * @property-read string $user_id
 * @property-read string $name
 * @property-read string $icon
 * @property-read string $type
 * @property-read bool $hasGlobalValue
 * @property-read  array<string, TItem> $data
 * @property-read string $created_at
 * @property-read string $updated_at
 */
final class EditorToken extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }
}
