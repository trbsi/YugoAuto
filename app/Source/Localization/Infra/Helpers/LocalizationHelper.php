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
        if (self::hasLocaleExtended()) {
            return self::getLocaleExtended()['locale'] ?? null;
        }
        return null;
    }


    public static function getCurrency(): null|string
    {
        if (self::hasLocaleExtended()) {
            return self::getLocaleExtended()['currency'] ?? null;
        }
        return null;
    }

    public static function getCountryId(): int
    {
        if (self::hasLocaleExtended()) {
            return self::getLocaleExtended()['countryId'] ?? Country::getDefaultCountry()->getId();
        }
        return Country::getDefaultCountry()->getId();
    }

    public static function getCurrencyWithDefaultFallback(): null|string
    {
        if (self::hasLocaleExtended()) {
            return self::getLocaleExtended()['currency'] ?? config('app.default_currency');
        }
        return config('app.default_currency');
    }

    public static function saveLocalization(Country $country): void
    {
        Session::put(LocaleEnum::LOCALE_EXTENDED->value, [
            'locale' => $country->getLocale(),
            'currency' => $country->getCurrency(),
            'countryId' => $country->getId()
        ]);
    }

    public static function saveLocalizationByLocale(string $locale): void
    {
        $country = Country::where('locale', $locale)->first();
        if ($country) {
            self::saveLocalization($country);
        }
    }

    public static function hasLocaleExtended(): bool
    {
        return Session::has(LocaleEnum::LOCALE_EXTENDED->value);
    }

    private static function getLocaleExtended(): array
    {
        return Session::get(LocaleEnum::LOCALE_EXTENDED->value);
    }
}
