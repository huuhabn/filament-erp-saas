<?php

namespace App\Shared\LanguageSwitcher;

use App\Filament\Components\LanguageSwitcher as LangSwitcher;

class SwitchLocaleService
{
    /**
     * @param  array<int, string>  $availableLocales
     */
    public function switch(string $locale, array $availableLocales): bool
    {
        if (! in_array($locale, $availableLocales, true)) {
            return false;
        }

        LangSwitcher::trigger(locale: $locale);

        return true;
    }
}
