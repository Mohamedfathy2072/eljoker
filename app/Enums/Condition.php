<?php

namespace App\Enums;

enum Condition: string
{
    case Exterior = 'exterior_condition';
    case Interior = 'interior_condition';
    case Mechanical = 'mechanical_condition';

    public function label(): string
    {
        return match ($this) {
            self::Exterior => 'Exterior Condition',
            self::Interior => 'Interior Condition',
            self::Mechanical => 'Mechanical Condition',
        };
    }
}
