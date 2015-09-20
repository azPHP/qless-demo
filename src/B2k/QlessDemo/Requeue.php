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

//        throw new \Exception('Something bad, man');
        sleep(5);
        $job->heartbeat();
        sleep(5);
        $job->heartbeat();
        sleep(5);
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
