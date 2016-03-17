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
    private $name;

    /**
     * Current library client class or its extending
     *
     * @var Client
     */
    private $client;

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
     * Common helper to make get requests
     *
     * @param string $request
     * @param array  $options
     *
     * @return Response
     */
    public function get($request, array $options = [])
    {
        return $this->request('GET', $request, $options);
    }

    /**
     * Common helper to make post requests
     *
     * @param string $request
     * @param array  $options
     *
     * @return Response
     */
    public function post($request, array $options = [])
    {
        return $this->request('POST', $request, $options);
    }

    /**
     * Common helper to make different requests via current library client
     *
     * @param string $method
     * @param string $request
     * @param array  $options
     *
     * @return Response
     *
     * @throws Exceptions\ClientException
     */
    public function request($method, $request, array $options = [])
    {
        return $this->client->request($method, $this->getRequestEndPoint($request), $options);
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
