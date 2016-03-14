<?php
namespace SlackApi\Modules;

use SlackApi\Client;

/**
 * Class AbstractModule
 * @package SlackApi\Modules
 */
abstract class AbstractModule
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $name;

    /**
     * AbstractModule constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->setClient($client);
        $this->initModuleName();
    }

    /**
     * @param Client $client
     * @return static
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param $name
     * @return static
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $request
     * @param array  $options
     * @return array
     */
    public function get($request, array $options = [])
    {
        return $this->getClient()->request('GET', $this->getRequestEndPoint($request), $options);
    }

    /**
     * @param string $request
     * @param array  $options
     * @return array
     */
    public function post($request, array $options = [])
    {
        return $this->getClient()->request('POST', $this->getRequestEndPoint($request), $options);
    }

    /**
     * @param string $request
     * @return string
     */
    public function getRequestEndPoint($request)
    {
        return strtolower($this->getName()) . '.' . $request;
    }

    /**
     * @return static
     */
    protected function initModuleName()
    {
        $class = get_called_class();
        $position = strrpos($class, '\\');
        if ($position) {
            $position = $position + 1;
        }
        $class = strtolower(substr($class, (int)$position));
        return $this->setName($class);
    }
}
