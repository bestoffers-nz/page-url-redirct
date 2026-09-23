<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| FINAL DESTINATION
|--------------------------------------------------------------------------
*/

$destination = 'https://boostscale.site/';


/*
|--------------------------------------------------------------------------
| PARAMETERS TO FORWARD
|--------------------------------------------------------------------------
*/

$allowed = [
    'gclid',
    'gbraid',
    'wbraid',
    'gad_source',
    'gad_campaignid',
    'utm_source',
    'utm_medium',
    'utm_campaign',
    'utm_term',
    'utm_content'
];

$params = [];

foreach ($allowed as $key) {

    if (!isset($_GET[$key])) {
        continue;
    }

    $value = trim((string) $_GET[$key]);

    if ($value === '') {
        continue;
    }

    $params[$key] = substr($value, 0, 250);
}


/*
|--------------------------------------------------------------------------
| ADD PARAMETERS TO FINAL URL
|--------------------------------------------------------------------------
*/

if (!empty($params)) {

    $query = http_build_query(
        $params,
        '',
        '&',
        PHP_QUERY_RFC3986
    );

    $destination .=
        (str_contains($destination, '?') ? '&' : '?')
        . $query;
}


/*
|--------------------------------------------------------------------------
| NO CACHE
|--------------------------------------------------------------------------
*/

header(
    'Cache-Control: no-store, no-cache, must-revalidate, max-age=0'
);

header('Pragma: no-cache');


/*
|--------------------------------------------------------------------------
| REDIRECT
|--------------------------------------------------------------------------
*/

header(
    'Location: ' . $destination,
    true,
    302
);

exit;