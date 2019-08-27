<?php

require_once 'vendor/autoload.php';

$config = require_once 'config.php';

use \DrewM\MailChimp\MailChimp;

$MailChimp = new MailChimp($config['mailChimpAPI-Key']);

$result = $MailChimp->get("lists/{$config['sourceListId']}/segments/{$config['sourceSegmentId']}/members");

$members = $result['members'];
if (count($members)) {
    $added = 0;
    foreach ($members as $member ) {
        echo "Moving {$member['email_address']}".PHP_EOL;
        $postURL = "lists/{$config['targetListId']}/members";
        $postBody = [
            'email_address' => $member['email_address'],
            'merge_fields' => $member['merge_fields'],
            'status' => $member['status'],
        ];
        $result = $MailChimp->post(
            $postURL,
            $postBody
        );

        $added += array_key_exists('id', $result ) ? 1 : 0;

        $MailChimp->delete("lists/{$config['sourceListId']}/members/{$member['id']}");
    }

    echo count($members)." subscribers found, $added moved to general list".PHP_EOL;
} else {
    echo 'No members to be moved found'.PHP_EOL;
}