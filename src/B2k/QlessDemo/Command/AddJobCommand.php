<?php
namespace B2k\QlessDemo\Command;


use B2k\QlessDemo\JobHandler;
use Qless\Client;
use Qless\Job;
use Qless\Queue;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddJobCommand extends Command
{
    public function configure()
    {
        $this->setName('qless:add-job')
            ->addOption('jid', null, InputOption::VALUE_REQUIRED, 'Job ID (to overwrite)', 'job.'.sha1(microtime()))
            ->addOption('klass', 'k', InputOption::VALUE_REQUIRED, 'Class to handle job', JobHandler::class)
            ->addOption('delay', null, InputOption::VALUE_REQUIRED, 'How long before we start the job', 0)
            ->addOption('retries', null, InputOption::VALUE_REQUIRED, 'How many retries', 0)
            ->addOption('interval', null, InputOption::VALUE_REQUIRED, 'How often job should heartbeat', 10)
            ->addArgument('queue', InputArgument::REQUIRED, 'Queue to run on')
            ->addArgument('data', InputArgument::OPTIONAL, 'Data to use for job (JSON)', '{fail:false,hang:false}');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $qname = $input->getArgument('queue');
        $config = require(realpath(__DIR__.'/../../../..').'/config.php');
        $client = new Client($config['redis']['host']);
        $queue = new Queue($qname, $client);
        $result = $queue->put(
            $input->getOption('klass') ?: null,
            $input->getOption('jid'),
            json_decode($input->getArgument('data')),
            intval($input->getOption('delay')),
            intval($input->getOption('retries')),
            true,
            0,
            [],
            intval($input->getOption('interval'))
        );

        $output->writeln($result);
    }
}
