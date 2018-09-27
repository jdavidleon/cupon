<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 9/26/2018
 * Time: 4:54 PM
 */

namespace AppBundle\Service;


use Psr\Log\LoggerInterface;

class MessageGenerator
{
    public function __construct(LoggerInterface $logger, $loggingEnabled)
    {
        $this->logger = $logger;
        $this->loggingEnabled = $loggingEnabled;
    }
    
    public function getHappyMessage(){

        if ($this->loggingEnabled){
            $this->logger->info('About to find a happy message');
        }

        $messages = array(
            'Primer mensaje',
            'Segundo mensaje',
            'Tercer mensaje',
        );

        $index = array_rand($messages);

        return $messages[$index];

    }
}