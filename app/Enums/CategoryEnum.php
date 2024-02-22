<?php

namespace App\Enums;

enum CategoryEnum: string
{
    case TOP = 'top';
    case TROUSER = 'trouser';
    case SKIRT = 'skirt';
    case SHORT = 'short';
    case DRESS = 'dress';

    public static function convertToEnum(string $category): CategoryEnum
    {
        return match ($category) {
            'top' => CategoryEnum::TOP,
            'trouser' => CategoryEnum::TROUSER,
            'skirt' => CategoryEnum::SKIRT,
            'short' => CategoryEnum::SHORT,
            'dress' => CategoryEnum::DRESS,
            default => throw new \Exception('Invalid category'),
        };
    }
}