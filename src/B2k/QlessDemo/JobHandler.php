<?php
namespace B2k\QlessDemo;

use Qless\Job;

class JobHandler {
    public function perform(Job $job){
        echo "Here in JobHandler perform";
        $instance = $job->getInstance();
        $data = $job->getData();
        $method = array_key_exists('performMethod', $data) ? $data['performMethod'] : 'work';
        $instance->$method($job);
    }
}