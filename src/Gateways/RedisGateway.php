<?php
namespace Evilamany\Rates\Gateways;

use RedisClient\ClientFactory;

class RedisGateway
{
    protected $client = null;

    public function setConnection(array $config) {
        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? '6379';

        $this->client = ClientFactory::create([
            'server' => $host .':'. $port,
            'password' => $config['password'] ?? null,
            'timeout' => 2
        ]);
    }

    public function subscribe(string $event, $callback) {
        $this->client->subscribe($event, $callback);

        return $this;
    }

    public function publish(string $event, string $value) {
        $this->client->publish($event, $value);

        return $this;
    }

    public function __call($name, $arguments) {
        call_user_func($this->client->{$name}, $arguments);

        return $this;
    }
}
