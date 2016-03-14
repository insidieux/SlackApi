<?php
namespace SlackApi;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use SlackApi\Exceptions\ClientException;
use SlackApi\Modules;

/**
 * Class Client
 * @package SlackApi
 *
 * @method Modules\Users users()
 */
class Client
{
    /**
     * @var string
     */
    private $baseUrl = 'https://slack.com/api';

    private $modulesDirectory = '\SlackApi\Modules';

    /**
     * @var string
     */
    protected $token;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $directories = [];

    /**
     * Client constructor.
     * @param string          $token
     * @param ClientInterface $client
     */
    public function __construct($token, ClientInterface $client)
    {
        $this->setToken($token);
        $this->setClient($client);
        $this->addDirectory($this->modulesDirectory);
    }

    /**
     * @param string $token
     * @return static
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @param ClientInterface $client
     * @return static
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @param string $directory
     * @return static
     */
    public function addDirectory($directory)
    {
        $this->directories[] = $directory;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }


    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return array
     */
    public function getDirectories()
    {
        return $this->directories;
    }

    /**
     * @param string $method
     * @param string $request
     * @param array  $options
     *
     * @throws ClientException
     *
     * @return array
     */
    public function request($method, $request, array $options = [])
    {
        try {
            $request = $this->prepareUri($request);
            $options = $this->prepareOptions($options);
            $response = $this->getClient()->request($method, $request, $options);
            $response = json_decode($response->getBody()->getContents(), true);
            if (!is_array($response)) {
                $message = 'Expected JSON-decoded response data to be of type "array", got "%s"';
                $message = sprintf($message, gettype($response));
                throw new ClientException($message);
            }
            return $response;
        } catch (\Exception $exception) {
            throw new ClientException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param string $name
     * @param mixed  $arguments
     * @return \SlackApi\Modules\AbstractModule
     *
     * @throws ClientException
     */
    public function __call($name, $arguments)
    {
        $name = ucfirst($name);
        foreach ($this->getDirectories() as $directory) {
            $class = "$directory\\$name";
            if (!class_exists($class, true)) {
                continue;
            }
            return new $class($this);
        }
        throw new ClientException("Invalid API module $name called, class could not be found");
    }

    /**
     * @param string $method
     * @return string
     */
    protected function prepareUri($method)
    {
        return $this->getBaseUrl() . '/' . $method;
    }

    /**
     * @param array $options
     * @return array
     */
    protected function prepareOptions(array $options = [])
    {
        $defaults = [
            RequestOptions::FORM_PARAMS => [
                'token' => $this->getToken()
            ]
        ];
        return array_merge_recursive($defaults, $options);
    }

    /**
     * @return string
     */
    protected function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
