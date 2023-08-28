<?php 

namespace App\Websockets\SocketHandler;

use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class UpdatePostSocketHandler extends BaseSocketHandler implements MessageComponentInterface{

    public function onMessage(ConnectionInterface $connection, MessageInterface $msg)
    {
        dump($msg->getPayload()); 

        $body = collect(json_decode($msg->getPayload(), true)); 
        $payload = $body->get('payload');
        $id = $body->get('id'); 
        dump($payload, $id); 
    
        // TODO: Implement onMessage() method.
    }
}