<?php
namespace SlackApi;

/**
 * Class AbstractModule
 *
 * @package SlackApi
 */
abstract class AbstractModule
{
    /**
     * API module name, which will be called at request
     *
     * @var string
     */
    protected $name;

    /**
     * Current library client class or its extending
     *
     * @var Client
     */
    protected $client;

    /**
     * AbstractModule constructor.
     *
     * @param string $name - API module name, which will be called at request
     * @param Client $client - current library client class or its extending
     */
    public function __construct($name, Client $client)
    {
        $this->name = strtolower($name);
        $this->client = $client;
    }

    /**
     * Common helper to make different requests via current library client

     * @param string $request
     * @param array  $parameters
     *
     * @return Response
     *
     * @throws Exceptions\ClientException
     */
    public function request($request, array $parameters = [])
    {
        return $this->client->request($this->getRequestEndPoint($request), $parameters);
    }

    /**
     * Method to make end point request. For example: if your module has attribute $name with value 'api',
     * and you make request 'test', the and point with transform to 'api.test'
     *
     * @param string $request
     *
     * @return string
     */
    private function getRequestEndPoint($request)
    {
        return $this->name . '.' . $request;
    }
}
