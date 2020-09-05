<?php

namespace App\Classes\Socket\Base;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class BaseSocket implements MessageComponentInterface
{
        public function onOpen(ConnectionInterface $conn) // when connection opened
    {
                // TODO: Implement onOpen() method.
            }

    public function onMessage(ConnectionInterface $from, $msg) // client -> server
    {
                // TODO: Implement onMessage() method.
            }

    public function onClose(ConnectionInterface $conn) // when connection closed
    {
                // TODO: Implement onClose() method.
            }

    public function onError(ConnectionInterface $conn, \Exception $e) // error on connection
    {
                // TODO: Implement onError() method.
            }
}