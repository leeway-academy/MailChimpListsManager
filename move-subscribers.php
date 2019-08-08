<?php

require_once 'vendor/autoload.php';

$config = require_once 'config.php';

use \DrewM\MailChimp\MailChimp;

$MailChimp = new MailChimp($config['mailChimpAPI-Key']);

$result = $MailChimp->get("lists/{$config['sourceListId']}/segments/{$config['sourceSegmentId']}/members");

if (count($result['members'])) {
    if (mail(
            $config['mailTo'],
            'Hay suscriptores listos para pasar a la lista general',
            "Se encontraron " . count($result['members']) . " listos para la lista general"
        ) == false) {
        echo 'Couldn\'t send email :(' . PHP_EOL;
    }
}

foreach ($result['members'] as $memberData) {
    echo 'Moving a member' . PHP_EOL;
}
