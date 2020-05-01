<?php

require __DIR__ . '/vendor/autoload.php';

use Pheanstalk\Pheanstalk;

// Create using autodetection of socket implementation
$queue = Pheanstalk::create('127.0.0.1');

if(isset($_POST['submit'])){
    $message = $_POST['message'];

    file_put_contents("process.log", $message." -> received.\n");

    // producer (queues jobs)
    $queue
    ->useTube('testtube')
    ->put($message);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
