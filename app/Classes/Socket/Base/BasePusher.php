<?php

namespace App\Classes\Socket\Base;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface;

class BasePusher implements WampServerInterface
{
    protected $subscribedTopics = [];

    public function getSubscribedTopics(){
        return $this->subscribedTopics;
    }

    public function addSubscribedTopic($topic){
        $this->subscribedTopics[$topic->getId()] = $topic;
    }

    public function onSubscribe(ConnectionInterface $conn, $topic)
    {
        $this->addSubscribedTopic($topic);
    }

    public function onUnSubscribe(ConnectionInterface $conn, $topic)
    {
        // TODO: Implement onUnSubscribe() method.
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo "New Connection !!! (Conn. Num.: " . $conn->resourceId . ")\n";
    }

    function onClose(ConnectionInterface $conn)
    {
        echo "Connection " . $conn->resourceId . " has disconnected!\n";
    }

    function onCall(ConnectionInterface $conn, $id, $topic, array $params)
    {
        // in this app if clients send data it's because the user hacked around in console
        $conn->callError($id, $topic, "You are not allowed to make calls!")->close();
    }

    function onPublish(ConnectionInterface $conn, $topic, $event, array $exclude, array $eligible)
    {
        // in this app if clients send data it's because the user hacked around in console
        $conn->close();
    }

    function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: " . $e->getMessage() . "\n";
        $conn->close();
    }
}