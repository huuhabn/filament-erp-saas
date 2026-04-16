<?php

namespace App\Shared\LanguageSwitcher;

use App\Filament\Components\LanguageSwitcher as LangSwitcher;

class LanguageSwitcherPresenter
{
    /**
     * @param  array<int, string>  $locales
     * @param  array<string, string>  $labels
     * @param  array<string, string>  $flags
     * @return array{
     *     languageSwitch: LangSwitcher,
     *     locales: array<int, string>,
     *     placement: string,
     *     isFlagsOnly: bool,
     *     isCircular: bool,
     *     hasFlags: bool
     * }
     */
    public function present(
        array $locales = ['en', 'vi'],
        array $labels = ['en' => 'English', 'vi' => 'Tiếng Việt'],
        array $flags = [],
        bool $isFlagsOnly = false,
        bool $circular = true,
    ): array {
        $languageSwitch = LangSwitcher::make()
            ->labels($labels)
            ->flagsOnly($isFlagsOnly)
            ->circular($circular);

        if (filled($flags)) {
            $languageSwitch->locales($flags);
        } else {
            $languageSwitch->locales($locales);
        }

        $resolvedFlags = $languageSwitch->getFlags();

        return [
            'languageSwitch' => $languageSwitch,
            'locales' => $languageSwitch->getLocales(),
            'placement' => $languageSwitch->getPlacement()->value,
            'isFlagsOnly' => $languageSwitch->isFlagsOnly(),
            'isCircular' => $languageSwitch->isCircular(),
            'hasFlags' => filled($resolvedFlags),
            'flag' => $languageSwitch->getFlag(app()->getLocale()) ?? null,
        ];
    }
}
