<?php

namespace Radiophonix\Services\FakeId;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Str;
use Radiophonix\Exceptions\FakeId\FakeIdException;

class FakeIdManager
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var array
     */
    private $connections;

    public function __construct(Config $config)
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
        $name = $this->name($name);

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

    private function name(string $name): string
    {
        if ($name !== 'media'
        ) {
            $name = Str::finish($name, 's');
        }

        return $name;
    }
}
