<?php
// create 1 message a second
require __DIR__ . '/../vendor/autoload.php';

use Pheanstalk\Pheanstalk;

// Create using autodetection of socket implementation
$queue = Pheanstalk::create('127.0.0.1');

$counter = 0;

// create job every 0-2 seconds
while (true) {
    $counter++;

    $message = 'job id '.$counter;

    sleep(rand(0,2));

    file_put_contents("process.log", $message." -> received.\n");

    $queue->useTube('testtube')->put($message);
}