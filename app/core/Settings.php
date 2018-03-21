<?php

/**
 * Suppose, you are browsing in your localhost
 * http://localhost/myproject/index.php?id=8
 */

function getBaseUrl()
{
    $use_forwarded_host = false;
    $ssl = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on');
    $server_protocol = strtolower($_SERVER['SERVER_PROTOCOL']);
    $protocol = substr($server_protocol, 0, strpos($server_protocol, '/')) . (($ssl) ? 's' : '');
    $port = $_SERVER['SERVER_PORT'];
    $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host = ($use_forwarded_host && isset($_SERVER['HTTP_X_FORWARDED_HOST'])) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $_SERVER['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

$BASE_URL = getBaseUrl();

/* Google App Client Id */
define('CLIENT_ID', 'xxxxxxxx');

/* Google App Client Secret */
define('CLIENT_SECRET', 'xxxxxxx');

/* Google App Redirect Url */
define('CLIENT_REDIRECT_URL', $BASE_URL);
