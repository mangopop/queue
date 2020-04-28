<?php
// cli-beanstalk-worker.php
// for testing of the BASH script
// exit (rand(95, 100));

/* normally we would return one of
# 97  - planned pause/restart
# 98  - planned restart
# 99  - planned stop, exit.
# anything else is an unplanned restart
*/

require __DIR__ . '/vendor/autoload.php';

use Pheanstalk\Pheanstalk;

// Create using autodetection of socket implementation
$pheanstalk = Pheanstalk::create('127.0.0.1');

$pheanstalk->watch('testtube');

// we can keeo the script alive with a while loop.
// or we can process each job per php script call via bash script.

while($job = $pheanstalk->ignore('default')->reserve()) {
// if(isset($job)) {
    // time takes to process job
    sleep(2);
    $pheanstalk->delete($job);    
    file_put_contents("process.log", $job->getData()." -> done.\n");

    // exit(98);
// } 
}

// exit(98);