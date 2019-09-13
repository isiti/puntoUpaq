<?php
require __DIR__ . '/../vendor/autoload.php';
use Minishlink\WebPush\WebPush;

// here I'll get the subscription endpoint in the POST parameters
// but in reality, you'll get this information in your database
// because you already stored it (cf. push_subscription.php)
$subscription = json_decode(file_get_contents('php://input'), true);

$auth = array(
    'VAPID' => array(
        'subject' => 'https://github.com/Minishlink/web-push-php-example/',
        'publicKey' => 'BKu8mJK4gLLWxPvw_1IZZqANa7IYQjSWy6azouuMJ49qu4V3ZgU7ejvQpmjRI7VFW3v6lOWHFSN026suPL2LwQo',
        'privateKey' => 'Re9SHKG_gWGw_cNyGY57SueZLN8AC_7Tv9g0Ve5Y-i0', // in the real world, this would be in a secret file
    ),
);

$webPush = new WebPush($auth);

$res = $webPush->sendNotification(
    $subscription['endpoint'],
    "Hello!",
    $subscription['key'],
    $subscription['token'],
    true
);

// handle eventual errors here, and remove the subscription from your server if it is expired
