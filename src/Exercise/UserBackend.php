<?php

namespace App\Exercise;

use Socket\Raw\Factory;

class UserBackend
{
    private string $server;
    private string $port;

    public function __construct()
    {
        $this->server = Config::getValue('server');
        $this->port   = Config::getValue('port');
    }

    public function getUsers(): array
    {
        $ch = \curl_init();
        \curl_setopt_array($ch, [
            CURL_URL               => $this->server,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $resp = \curl_exec($ch);
        $httpCode = \curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return \json_decode($resp);
    }

    public function auth(string $user, string $password): bool
    {
        $factory = new Factory();

        $address = sprintf("%s:%s", $this->server, $this->port);
        $socket = $factory->createClient($address);
        $socket->write("CHECK_USER $user:$password\r\n\r\n");
        $data = $socket->read(8192);
        $socket->close();

        return 'OK' === $data;
    }
}