<?php

namespace App\Enums;

enum RefurbishmentStatus: string
{
    case Empty = 'empty';
    case LimitedOffer = 'limited_offer';
    case FullyRefurbished = 'fully_refurbished';
    case CertifiedRefurbished = 'certified_refurbished';

    public function label(): string
    {
        return match ($this) {
            self::Empty => 'Empty',
            self::LimitedOffer => 'Limited Time Offer',
            self::FullyRefurbished => 'Fully Refurbished',
            self::CertifiedRefurbished => 'Certified Refurbished',
        };
    }
}
