<?php
$_COOKIE['cookieyes-consent'] = "consentid:abc,consent:yes,action:yes,necessary:yes,functional:yes,analytics:yes,performance:yes,advertisement:yes";
$CookieConsent = array_column(array_map(function ($pair) {
    return explode(':', $pair);
}, explode(',', $_COOKIE['cookieyes-consent'])), 1, 0);
var_dump($CookieConsent);
var_dump(filter_var($CookieConsent['functional'] ?? false, FILTER_VALIDATE_BOOLEAN));
