<?php
namespace B2k\QlessDemo;


use Qless\Job;

class Worker
{
    public function doWork(Job $job)
    {
        $data = $job->getData();
        $jid  = $job->getId();

        sleep(5);
        $job->heartbeat();
        sleep(2);
        $job->complete();
    }
}
