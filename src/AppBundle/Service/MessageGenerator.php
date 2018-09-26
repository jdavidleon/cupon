<?php
/**
 * Created by PhpStorm.
 * User: JLEON
 * Date: 9/26/2018
 * Time: 4:54 PM
 */

namespace AppBundle\Service;


class MessageGenerator
{
    public function getHappyMessage(){

        $messages = array(
            'Primer mensaje',
            'Segundo mensaje',
            'Tercer mensaje',
        );

        $index = array_rand($messages);

        return $messages[$index];

    }
}