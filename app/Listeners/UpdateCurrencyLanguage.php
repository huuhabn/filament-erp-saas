<?php

namespace App\Listeners;

use App\Events\LangChanged;
use App\Models\Company;

readonly class UpdateCurrencyLanguage
{
    /**
     * Handle the event.
     */
    public function handle(LangChanged $event): void
    {
        $companyId = auth()->user()->current_company_id;

        if (! $companyId) {
            return;
        }

        $company = Company::with(['locale'])->find($companyId);

        if (! $company) {
            return;
        }

        $company->locale()->update(['language' => $event->locale]);

        \App\Services\CompanySettingsService::invalidateSettings($companyId);
    }
}
