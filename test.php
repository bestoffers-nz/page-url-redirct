<?php
declare(strict_types=1);

$destination = 'https://boostscale.site/';

if (isset($_GET['gad_campaignid'])) {

    $params = $_GET;

    $destination .=
        (str_contains($destination, '?') ? '&' : '?') .
        http_build_query($params, '', '&', PHP_QUERY_RFC3986);

    header('Cache-Control: no-store');
    header('Location: ' . $destination, true, 302);
    exit;
}
?>