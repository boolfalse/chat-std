<?php

namespace App\Classes\Socket;

use App\Classes\Socket\Base\BasePusher;
use ZMQContext;

class Pusher extends BasePusher
{
    static function sentDataToServer(array $data)
    { // Send data to PushServer, which later will share data to subscribers
        $context = new ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my_pusher');
        $socket->connect("tcp://127.0.0.1:5555");
        $socket->send(json_encode($data));
    }

    public function broadcast($jsonDataToSend){
        $aDataToSend = json_decode($jsonDataToSend, true);
        $subscribedTopics = $this->getSubscribedTopics();
        if(isset($subscribedTopics[$aDataToSend['topic_id']])){
            $topic = $subscribedTopics[$aDataToSend['topic_id']];
            $topic->broadcast($aDataToSend);
        }
    }
}