<?php
namespace B2k\QlessDemo\Log;


use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class ConsoleLogger implements LoggerInterface
{
    use LoggerTrait;

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = [])
    {
        $dt = date('Y-m-d H:i:s');
        echo "[{$level}] [{$dt}] {$message} - ";
        echo json_encode($context)."\n";
    }
}
