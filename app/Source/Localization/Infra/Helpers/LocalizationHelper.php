<?php

declare(strict_types=1);

namespace App\Source\Localization\Infra\Helpers;

use App\Models\Country;
use App\Source\Localization\Domain\Enum\LocaleEnum;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;

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

    public static function saveLocalization(Country $country): SymfonyCookie
    {
        return Cookie::forever(
            LocaleEnum::LOCALE_EXTENDED->value,
            json_encode([
                'locale' => $country->getLocale(),
                'currency' => $country->getCurrency(),
                'countryId' => $country->getParentId() ?: $country->getId()
            ])
        );
    }

    public static function hasLocaleExtended(): bool
    {
        return Cookie::has(LocaleEnum::LOCALE_EXTENDED->value);
    }

    private static function getLocaleExtended(): array
    {
        return json_decode(Cookie::get(LocaleEnum::LOCALE_EXTENDED->value), true);
    }
}
