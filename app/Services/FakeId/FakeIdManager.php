<?php

namespace Radiophonix\Services\FakeId;

use Illuminate\Contracts\Config\Repository;
use Radiophonix\Exceptions\FakeId\FakeIdException;

class FakeIdManager
{
    /**
     * @var Repository
     */
    private $config;

    /**
     * @var array
     */
    private $connections;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $name
     * @return FakeIdConnection
     * @throws FakeIdException
     */
    public function connection(string $name): FakeIdConnection
    {
        if (!isset($this->connections[$name])) {
            $config = $this->config->get('fakeid.connections.' . $name);

            if (null === $config) {
                throw FakeIdException::invalidConnection($name);
            }

            $this->connections[$name] = new FakeIdConnection(
                $config['prime'],
                $config['inverse'],
                $config['xor']
            );
        }

        return $this->connections[$name];
    }
}
