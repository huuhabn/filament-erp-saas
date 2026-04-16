<?php

namespace App\Enums\Common;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasIcon;

enum OfferingType: string implements HasIcon, HasLabel
{
    case Product = 'product';
    case Service = 'service';

    public function getLabel(): string
    {
        return $this->name;
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Product => 'heroicon-o-cube-transparent',
            self::Service => 'heroicon-o-briefcase',
        };
    }
}
