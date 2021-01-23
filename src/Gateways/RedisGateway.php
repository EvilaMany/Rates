<?php
namespace Evilamany\Rates\Gateways;

//use RedisClient\ClientFactory;

class RedisGateway
{
    protected $client = null;

    public function __construct(array $config) {
        $host = $config['host'] ?? '127.0.0.1';
        $port = $config['port'] ?? '6379';


		$this->client = new \Redis;
		$this->client->connect($host, $port);
        /*$this->client = ClientFactory::create([
            'server' => $host .':'. $port,
            'password' => $config['password'] ?? null,
            'timeout' => 2
        ]);*/
    }

    public function subscribe(string $event, $callback) {
        $this->client->subscribe([$event], $callback);
    }

    public function publish(string $event, string $value) {
        $this->client->publish($event, $value);
    }

    public function __call($name, $arguments) {
        return call_user_func_array([$this->client, $name], $arguments);
    }
}
