<?php
require __DIR__ . '/vendor/autoload.php';

use Pheanstalk\Pheanstalk;

// Create using autodetection of socket implementation
$pheanstalk = Pheanstalk::create('127.0.0.1');

// ----------------------------------------
// producer (queues jobs)

$pheanstalk
  ->useTube('testtube')
  ->put("job payload goes here\n");

// ----------------------------------------
// worker (performs jobs)

$job = $pheanstalk->watch('testtube')
    ->ignore('default')
    ->reserve();

echo $job->getData();

$pheanstalk->delete($job);

