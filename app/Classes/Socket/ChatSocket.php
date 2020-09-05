<?php

namespace App\Classes\Socket;

use App\Classes\Socket\Base\BaseSocket;
use Ratchet\ConnectionInterface;

class ChatSocket extends BaseSocket
{
        protected $clients; // clients connections

    public function __construct()
    {
                $this->clients = new \SplObjectStorage();
            }

    public function onOpen(ConnectionInterface $conn) // when connection opened
    {
                // Store this new connection to send messages later
                $this->clients->attach($conn);
                echo "New Connection!!! (Conn. num.: " . $conn->resourceId . ")\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) // client -> server
    {
                $numRecv = count($this->clients) - 1;
                echo sprintf("Connection %d sending message %s to %d other connections" . "\n" ,
                        $from->resourceId, $msg, $numRecv, $numRecv==1 ? '' : 's');
        foreach ($this->clients as $client){
                        if($from !== $client){
                                $client->send($msg); // this sener is not the receiver, send to each client connected
                            }
        }
    }

    public function onClose(ConnectionInterface $conn) // when connection closed
    {
                // The connection is closed, remove it, as we can no longer send it message
                $this->clients->detach($conn);
                echo "Connection " . $conn->resourceId . " has disconnected !!!\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) // error on connection
    {
                echo "An error has occured: " . $e->getMessage() . "\n";
        $conn->close();
    }
}