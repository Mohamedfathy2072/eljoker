<?php

namespace App\Enums;

enum Feature: string
{
    case Performance = 'performance';
    case ComfortConvenience = 'comfort_convenience';
    case EntertainmentCommunication = 'entertainment_communication';
    case Interiors = 'interiors';
    case Safety = 'safety';
    case Exteriors = 'exteriors';
    case DimensionsCapacity = 'dimensions_capacity';


    public function label(string $locale): string
    {
        return match ($locale) {
            default => $this->EnglishLabel(),
            'ar' => $this->arabicLabel(),
        };
    }

    public function arabicLabel(): string
    {
        return match ($this) {
            self::Performance => 'الأداء',
            self::ComfortConvenience => 'الراحة والرفاهية',
            self::EntertainmentCommunication => 'الترفيه والاتصالات',
            self::Interiors => 'التصميم الداخلي',
            self::Safety => 'السلامة',
            self::Exteriors => 'التصميم الخارجي',
            self::DimensionsCapacity => 'الأبعاد والسعة',
        };
    }

    public function EnglishLabel(): string 
    {
        return match($this){
            self::Performance => 'Performance',
            self::ComfortConvenience => 'Comfort & Convenience',
            self::EntertainmentCommunication => 'Entertainment & Communication',
            self::Interiors => 'Interiors',
            self::Safety => 'Safety',
            self::Exteriors => 'Exteriors',
            self::DimensionsCapacity => 'Dimensions & Capacity',
        };
    }
}
