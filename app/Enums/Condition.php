<?php

namespace App\Enums;

enum Condition: string
{
    case Exterior = 'Exterior';
    case Interior = 'Interior';
    case Mechanical = 'Mechanical';

    public function label($local): string
    {
        return match($local) {
            default => $this->EnglishConditions(),
            'ar' => $this->ArabicConditions(),
        };
    }

    public function ArabicConditions(): string 
    {
        return match($this) {
            self::Exterior => 'حالة الهيكل الخارجي',
            self::Interior => 'حالة التصميم الداخلي',
            self::Mechanical => 'الحالة الميكانيكية',
        }; 
    }

    public function EnglishConditions(): string 
    {
        return match($this) {
            self::Exterior =>  'exterior condition',
            self::Interior => 'interior condition',
            self::Mechanical => 'mechanical condition',
        }; 
    }
}
