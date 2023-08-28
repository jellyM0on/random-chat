<?php 

namespace App\Websockets\SocketHandler;

use Ratchet\ConnectionInterface;
use BeyondCode\LaravelWebSockets\Apps\App;
use Ratchet\WebSocket\MessageComponentInterface;
use BeyondCode\LaravelWebSockets\QueryParameters;
use BeyondCode\LaravelWebSockets\WebSockets\Exceptions\UnknownAppKey;

abstract class BaseSocketHandler implements MessageComponentInterface {
    protected function verifyAppKey(ConnectionInterface $connection)
    {
        $appKey = QueryParameters::create($connection->httpRequest)->get('appKey');

        if (! $app = App::findByKey($appKey)) {
            throw new UnknownAppKey($appKey);
        }

        $connection->app = $app;

        return $this;
    }

    protected function generateSocketId(ConnectionInterface $connection)
    {
        $socketId = sprintf('%d.%d', random_int(1, 1000000000), random_int(1, 1000000000));

        $connection->socketId = $socketId;

        return $this;
    }

    
    public function onOpen(ConnectionInterface $connection)
    {
        dump('on opened'); 
        //auth logic 

        $this->verifyAppKey($connection)->generateSocketId($connection); 
    }
    
    public function onClose(ConnectionInterface $connection)
    {
        dump('closed'); 
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
       dump($e); 
       dump('onerror'); 
    }
}