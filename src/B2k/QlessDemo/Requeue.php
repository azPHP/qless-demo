<?php
namespace B2k\QlessDemo;


use Qless\Job;

class Requeue
{
    public function perform(Job $job)
    {
        $data = $job->getData();
        $jid  = $job->getId();
        echo $jid."\n";

        sleep(5);
        $job->heartbeat();
        sleep(2);
//        $job->complete();
//        return;
        $job->requeue([
            'data' => [
                'time' => time(),
                'thing' => [
                    'blah' => 'foo'
                ]
            ]
        ]);
        return false;
    }
}
