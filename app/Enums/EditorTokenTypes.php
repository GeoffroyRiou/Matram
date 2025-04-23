<?php

declare(strict_types=1);

namespace App\Enums;

enum EditorTokenTypes: string
{
    case TEXT = 'text';
    case NUMBER = 'number';
    case COLORED_RANGE = 'colored_range';

    public function label(string $icon): string
    {
        return match ($icon) {
            self::TEXT->value => __('Text'),
            self::NUMBER->value => __('Number'),
            self::COLORED_RANGE->value => __('Colored Range'),
            default => __('Unknown'),
        };
    }
}
