<?php
namespace SlackApi;

use SlackApi\Exceptions\ClientException;
use SlackApi\Models\Attachment;
use SlackApi\Models\AttachmentField;
use SlackApi\Models\Message;
use SlackApi\Modules;

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
     * Slack API base URL
     */
    const API_URL = 'https://slack.com/api';

    /**
     * Default curl request timeout
     */
    const DEFAULT_REQUEST_TIMEOUT = 3;

    /**
     * API token
     *
     * @var string
     */
    protected $token;

    /**
     * Curl request timeout
     *
     * @var int
     */
    protected $timeout = self::DEFAULT_REQUEST_TIMEOUT;

    /**
     * Array of initialized modules for API calls
     *
     * @var array
     */
    protected $modules = [];

    /**
     * Client constructor.
     * @param string $token - API token
     */
    public function __construct($token)
    {
        $this->token = $token;

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
     * Common method to make request to Slack API endpoint
     *
     * @param string $endpoint - API method, such as api.test
     * @param array  $parameters - parameters for current API METHOD (if need to send)
     *
     * @return Response - current library Response object
     *
     * @throws ClientException
     */
    public function request($endpoint, array $parameters = [])
    {
        $parameters['token'] = $this->token;

        $handler = curl_init();
        curl_setopt($handler, CURLOPT_URL, self::API_URL . '/' . $endpoint);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handler, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($handler, CURLOPT_POST, true);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handler, CURLOPT_POSTFIELDS, http_build_query($parameters));
        $response = curl_exec($handler);
        curl_close($handler);

        return $this->prepareResponse($response);
    }

    /**
     * Magic call, need for calling API modules, such as users/chat and e.t.c.
     *
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
     * Create Message model
     *
     * @return Message
     */
    public function makeMessage()
    {
        return new Message($this);
    }

    /**
     * Create Attachment model
     *
     * @param array $attributes
     *
     * @return Attachment
     */
    public function makeAttachment(array $attributes = [])
    {
        return new Attachment($attributes);
    }

    /**
     * Create AttachmentField model
     *
     * @param array $attributes
     *
     * @return AttachmentField
     */
    public function makeAttachmentField(array $attributes = [])
    {
        return new AttachmentField($attributes);
    }

    /**
     * Return current library Response object or throw ClientException if json_decode failed
     *
     * @param string $response
     *
     * @return Response
     *
     * @throws ClientException
     */
    public function prepareResponse($response)
    {
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

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }
}
