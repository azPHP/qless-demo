<?php
namespace B2k\QlessDemo\Command;

use Qless\Client;
use Qless\Queue;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class QlessStatusCommand extends Command
{
    public function configure()
    {
        $this->setName('qless:status')
            ->setDescription('Get info on current redis queue')
            ->addArgument('queue', InputArgument::REQUIRED, 'Queue to stat');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $qname = $input->getArgument('queue');
        $config = require(realpath(__DIR__.'/../../../..').'/config.php');
        $qless = new Queue($qname, new Client($config['redis']['host']));

        $stats = $qless->stats();

        $output->write($stats);
    }
}
