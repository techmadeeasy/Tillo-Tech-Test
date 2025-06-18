<?php

function formatMoney($amount)
{
    return \Interview2025\CurrencyEnum::GBP->getSymbol() .  number_format($amount, 2, ',', '.');
}