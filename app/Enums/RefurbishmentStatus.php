<?php

namespace App\Enums;

enum RefurbishmentStatus: string
{
    case Empty = 'empty';
    case LimitedOffer = 'limited_offer';
    case FullyRefurbished = 'fully_refurbished';
    case CertifiedRefurbished = 'certified_refurbished';

    public function label(string $locale = 'en'): string
    {
        return match($locale) {
            'ar' => $this->arabicLabel(),
            default => $this->englishLabel(),
        };
    }

    private function englishLabel(): string
    {
        return match ($this) {
            self::Empty => 'Empty',
            self::LimitedOffer => 'Limited Time Offer',
            self::FullyRefurbished => 'Fully Refurbished',
            self::CertifiedRefurbished => 'Certified Refurbished',
        };
    }

    private function arabicLabel(): string
    {
        return match ($this) {
            self::Empty => 'فارغ',
            self::LimitedOffer => 'عرض محدود',
            self::FullyRefurbished => 'تم تجديده بالكامل',
            self::CertifiedRefurbished => 'تم تجديده ومعتمد',
        };
    }
}