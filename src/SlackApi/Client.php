<?php
namespace SlackApi;

use \Guzzle\Http\Message\RequestInterface;

use \GuzzleHttp\ClientInterface;
use \GuzzleHttp\RequestOptions;

use SlackApi\Exceptions\ClientException;
use SlackApi\Modules;

use \Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package SlackApi
 *
 * @method Modules\Channels     channels()
 * @method Modules\Chat         chat()
 * @method Modules\Dnd          dnd()
 * @method Modules\Emoji        emoji()
 * @method Modules\Files        files()
 * @method Modules\Groups       groups()
 * @method Modules\Im           im()
 * @method Modules\Oauth        oauth()
 * @method Modules\Pins         pins()
 * @method Modules\Search       search()
 * @method Modules\Team         team()
 * @method Modules\UserGroups   usergroups()
 * @method Modules\Users        users()
 */
class Client
{
    /**
     *
     */
    const API_URL = 'https://slack.com/api';

    /**
     * API token
     *
     * @var string
     */
    private $token;

    /**
     * Guzzle client for making http/curl requests to API
     *
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string[]
     */
    private $modules = [];

    /**
     * Client constructor.
     * @param string          $token - API token
     * @param ClientInterface $client - Guzzle client for making http/curl requests to API
     */
    public function __construct($token, ClientInterface $client)
    {
        $this->token = $token;
        $this->client = $client;

        $directory = __DIR__ . DIRECTORY_SEPARATOR . 'Modules' . DIRECTORY_SEPARATOR;
        $namespace = __NAMESPACE__ . '\\Modules\\';
        foreach (glob($directory . '*.php') as $file) {
            if (sscanf($file, $directory . '%s.php', $file) !== false) {
                $file = str_replace(['/', '.php'], ['\\', ''], $file);
                $this->registerModule($file, $namespace . $file);
            }
        }
    }

    /**
     * Set Guzzle client for making http/curl requests to API
     *
     * @param ClientInterface $client
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Register class with API implementation for next calls, associated with API module
     *
     * @param string $module - API module, for example 'Users'
     * @param string $class - class name with methods implementation. MUST extends AbstractModule class
     *
     * @return $this
     *
     * @throws ClientException
     */
    public function registerModule($module, $class)
    {
        if (!class_exists($class, true)) {
            throw new ClientException("Class $class doesn't exists");
        }
        $module = $this->prepareModuleName($module);
        $this->modules[$module]['class'] = $class;
        return $this;
    }

    /**
     * @param string $method - HTTP method - GET/POST/PUT and e.t.c (see RequestInterface:: const)
     * @param string $request - API method, such as api.test
     * @param array  $parameters - parameters for current API METHOD (if need to send)
     *
     * @return Response - current library Response object
     *
     * @throws ClientException
     */
    public function request($method, $request, array $parameters = [])
    {
        try {
            $options = [
                RequestOptions::FORM_PARAMS => [
                    'token' => $this->token
                ]
            ];
            if (!empty($parameters)) {
                switch ($method) {
                    case RequestInterface::POST:
                        foreach ($parameters as $parameter => $value) {
                            $options[RequestOptions::FORM_PARAMS][$parameter] = $value;
                        }
                        break;
                    case RequestInterface::GET:
                    default:
                        $request .= '?' . http_build_query($parameters);
                        break;
                }
            }
            $response = $this->client->request($method, self::API_URL . '/' . $request, $options);
            return $this->prepareResponse($response);
        } catch (\Exception $exception) {
            throw new ClientException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param string $name - API module name for next calls
     * @param mixed  $arguments
     *
     * @return \SlackApi\AbstractModule
     *
     * @throws ClientException
     */
    public function __call($name, $arguments)
    {
        $name = $this->prepareModuleName($name);
        if (!isset($this->modules[$name])) {
            throw new ClientException("Module $name is not registered");
        }

        $module = $this->modules[$name];
        if (!isset($module['object'])) {
            $module['object'] = new $module['class']($name, $this);
        }

        if (!($module['object'] instanceof AbstractModule)) {
            throw new ClientException("Class for module $name is not instance of AbstractModule");
        }

        return $module['object'];
    }

    /**
     * Return current library Response object or throw ClientException if json_decode failed
     *
     * @param ResponseInterface $response
     *
     * @return Response
     *
     * @throws ClientException
     */
    public function prepareResponse(ResponseInterface $response)
    {
        $response = $response->getBody()->getContents();
        $response = json_decode($response, true);
        if (!is_array($response)) {
            $message = 'Expected JSON-decoded response data to be of type "array", got "%s"';
            $message = sprintf($message, gettype($response));
            throw new ClientException($message);
        }
        return new Response($response);
    }

    /**
     * Prepare API module name for next usages
     * - in register modules
     * - in magic __call method
     *
     * @param string $module
     *
     * @return string
     */
    private function prepareModuleName($module)
    {
        $module = (string)$module;
        $module = strtolower($module);
        return ucfirst($module);
    }
}
