<?php

$vars = array(
    "TM_TEST_ACCOUNTCODE" => "Account code (short name)",
    "TM_TEST_ACCESSKEY"   => "API access key",
    "TM_TEST_SECRETKEY"   => "API secret key",
);
$ok = true;
foreach ($vars as $var => $value) {
    if (!isset($_SERVER[$var])) {
        $ok = false;
    }
}

if (!$ok) {
    echo "Test configuration missing\n";
    echo "==========================\n";
    echo "\n";
    echo "You need to set a number of environment variables to run the tests:\n";
    echo "\n";
    foreach ($vars as $key => $value) {
        echo " * $key:\t$value\n";
    }
    echo "\n";
    exit(1);
}

require __DIR__ . "/../vendor/autoload.php";

\Ticketmatic\Client::$server = isset($_SERVER["TM_TEST_SERVER"]) ? $_SERVER["TM_TEST_SERVER"] : "https://qa.ticketmatic.com";
