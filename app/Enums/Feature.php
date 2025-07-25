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

    public function label(): string
    {
        return match ($this) {
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
