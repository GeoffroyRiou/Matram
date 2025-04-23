<?php

declare(strict_types=1);

namespace App\Enums;

enum EditorTokenIcons: string
{
    case PLUS = 'plus';
    case CHECK = 'check';
    case NOTE = 'note';
    case QUESTION = 'question';

    public function label(string $icon): string
    {
        return match ($icon) {
            self::PLUS->value => __('Plus'),
            self::CHECK->value => __('Check'),
            self::NOTE->value => __('Note'),
            self::QUESTION->value => __('Question'),
            default => __('Unknown'),
        };
    }
}
