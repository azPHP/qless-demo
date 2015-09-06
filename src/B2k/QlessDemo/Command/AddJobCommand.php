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
            ->addOption('jid', null, InputOption::VALUE_REQUIRED, 'Job ID (to overwrite)', microtime(true))
            ->addOption('delay', null, InputOption::VALUE_REQUIRED, 'Seconds of delay', 0)
            ->addOption('klass', 'k', InputOption::VALUE_REQUIRED, 'Class to handle job', JobHandler::class)
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
            json_decode($input->getArgument('data'))
        );

        $output->writeln($result);
    }
}
