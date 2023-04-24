<?php

declare(strict_types=1);

namespace App\Source\Localization\Infra\Helpers;

use App\Models\Country;
use App\Source\Localization\Domain\Enum\LocaleEnum;
use Illuminate\Support\Facades\Session;

class LocalizationHelper
{
    public static function getLocale(): null|string
    {
        return self::hasLocaleExtended() ?
            self::getLocaleExtended()['locale'] :
            null;
    }


    public static function getCurrency(): null|string
    {
        return self::hasLocaleExtended() ?
            self::getLocaleExtended()['currency'] :
            null;
    }

    public static function getCurrencyWithDefaultFallback(): null|string
    {
        return self::hasLocaleExtended() ?
            self::getLocaleExtended()['currency'] :
            config('app.default_currency');
    }

    public static function saveLocalization(Country $country): void
    {
        Session::put(LocaleEnum::LOCALE_EXTENDED->value, [
            'locale' => $country->getLocale(),
            'currency' => $country->getCurrency()
        ]);
    }

    private static function getLocaleExtended(): array
    {
        return Session::get(LocaleEnum::LOCALE_EXTENDED->value);
    }

    private static function hasLocaleExtended(): bool
    {
        return Session::has(LocaleEnum::LOCALE_EXTENDED->value);
    }
}
