<?php

require_once 'vendor/autoload.php';

$config = require_once 'config.php';

use \DrewM\MailChimp\MailChimp;

$MailChimp = new MailChimp($config['mailChimpAPI-Key']);

$result = $MailChimp->post(
    "automations/{$argv[1]}/emails/{$argv[2]}/queue",
    [
        'email_address' => $argv[3],
    ]
);

if ( is_array($result) && $result['status'] !== 200 ) {
    echo 'Error ocurred: '.$result['detail'].PHP_EOL;
} else {
    echo "{$argv[3]} added to automation!".PHP_EOL;
}

die(PHP_EOL);