<?php

namespace App\Livewire;

use App\Shared\LanguageSwitcher\LanguageSwitcherPresenter;
use App\Shared\LanguageSwitcher\SwitchLocaleService;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    /**
     * @var array<int, string>
     */
    public array $locales = [];

    /**
     * @var array<string, string>
     */
    public array $labels = [];

    /**
     * @var array<string, string>
     */
    public array $flags = [];

    /**
     * @var bool
     */
    public bool $isFlagsOnly = false;

    /**
     * @var bool
     */
    public bool $circular = true;

    protected LanguageSwitcherPresenter $languageSwitcherPresenter;

    protected SwitchLocaleService $switchLocaleService;

    public function boot(
        LanguageSwitcherPresenter $languageSwitcherPresenter,
        SwitchLocaleService $switchLocaleService
    ): void {
        $this->languageSwitcherPresenter = $languageSwitcherPresenter;
        $this->switchLocaleService = $switchLocaleService;
    }

    #[On('language-switched')]
    public function changeLocale(string $locale): void
    {
        $viewData = $this->languageSwitcherPresenter->present($this->locales, $this->labels, $this->flags);

        if (! $this->switchLocaleService->switch($locale, $viewData['locales'])) {
            return;
        }

        $this->redirect(request()->header('Referer') ?? url()->current());
    }

    public function render(): View
    {
        return view('livewire.language-switcher', $this->languageSwitcherPresenter->present(
            $this->locales,
            $this->labels,
            $this->flags,
            $this->isFlagsOnly,
            $this->circular
        ));
    }
}
