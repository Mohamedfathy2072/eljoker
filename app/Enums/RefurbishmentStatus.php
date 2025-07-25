<?php

namespace App\Enums;

enum RefurbishmentStatus: string
{
    case NotRefurbished = 'not_refurbished';
    case PartiallyRefurbished = 'partially_refurbished';
    case FullyRefurbished = 'fully_refurbished';
    case CertifiedRefurbished = 'certified_refurbished';

    public function label(): string
    {
        return match ($this) {
            self::NotRefurbished => 'Not Refurbished',
            self::PartiallyRefurbished => 'Partially Refurbished',
            self::FullyRefurbished => 'Fully Refurbished',
            self::CertifiedRefurbished => 'Certified Refurbished',
        };
    }
}
