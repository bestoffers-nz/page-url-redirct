<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| CONFIGURATION
|--------------------------------------------------------------------------
*/

$destination = 'https://boostscale.site/';

$allowedParams = [
    'gad_campaignid',
    'gclid',
    'gbraid',
    'wbraid',
    'gad_source',
    'utm_source',
    'utm_medium',
    'utm_campaign',
    'utm_term',
    'utm_content'
];


/*
|--------------------------------------------------------------------------
| SECURITY / CACHE HEADERS
|--------------------------------------------------------------------------
*/

header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');


/*
|--------------------------------------------------------------------------
| READ PARAMETERS
|--------------------------------------------------------------------------
*/

$params = [];

foreach ($allowedParams as $key) {

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
| CHECK REQUIRED PARAMETER
|--------------------------------------------------------------------------
*/

if (isset($params['gad_campaignid'])) {

    /*
    |--------------------------------------------------------------------------
    | BUILD FINAL DESTINATION
    |--------------------------------------------------------------------------
    */

    $queryString = http_build_query(
        $params,
        '',
        '&',
        PHP_QUERY_RFC3986
    );

    if ($queryString !== '') {

        $separator = str_contains($destination, '?')
            ? '&'
            : '?';

        $destination .= $separator . $queryString;
    }


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
}


/*
|--------------------------------------------------------------------------
| NO gad_campaignid
|--------------------------------------------------------------------------
|
| Render URL directly open hua aur gad_campaignid nahi mila,
| to simple response show hoga.
|
*/

http_response_code(200);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="robots"
          content="noindex,nofollow">

    <title>Redirect Service</title>

</head>

<body>

    <p>Request received.</p>

</body>

</html>