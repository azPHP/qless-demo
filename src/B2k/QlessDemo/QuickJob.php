<?php
namespace B2k\QlessDemo;

use Qless\Job;

class QuickJob {
    public function perform(Job $job) {
        $job->complete();
    }
}
