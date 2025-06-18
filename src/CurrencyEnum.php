<?php

namespace Interview2025;
enum CurrencyEnum
{
    case USD;
    case GBP;

    //.....

    public function getSymbol(): string
    {
        return match ($this) {
            self::USD => '$',
            self::GBP => '£',
        };
    }
}
