<?php

require_once 'vendor/autoload.php';

$config = require_once 'config.php';

use \DrewM\MailChimp\MailChimp;

    $MailChimp = new MailChimp($config['mailChimpAPI-Key']);

    $result = $MailChimp->get("lists/{$config['sourceListId']}/segments/{$config['sourceSegmentId']}/members");

    foreach( $result['members'] as $memberData ) {
        echo 'Moving a member'.PHP_EOL;
    }
