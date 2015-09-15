<?php
namespace B2k\QlessDemo;

use Qless\Job;

class HangingJob {
    public function perform(Job $job) {
        echo "starting job\n";
        sleep(30);
        $job->heartbeat();
        echo "still jobbing\n";
        sleep(2);
        echo "job's done\n";
        $job->complete();
    }
}
