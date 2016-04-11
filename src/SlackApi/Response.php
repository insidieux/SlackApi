<?php
namespace SlackApi;

/**
 * Class Response
 *
 * @package SlackApi
 */
class Response
{
    /**
     * @var array
     */
    protected $response;

    /**
     * Response constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
     * Return full json decoded response data as array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }

    /**
     * Get list of response fields
     *
     * @return array
     */
    public function getFields()
    {
        return array_keys($this->response);
    }

    /**
     * Get response field value. Return default value if field does not exist
     *
     * @param string $field
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($field, $default = null)
    {
        return $this->has($field) ? $this->response[$field] : $default;
    }

    /**
     * Check field exists in response
     *
     * @param string $field
     *
     * @return bool
     */
    public function has($field)
    {
        return isset($this->response[$field]);
    }

    /**
     * Check response status is ok (field 'ok' === true)
     *
     * @return bool
     */
    public function isSuccess()
    {
        return $this->get('ok', false) == true;
    }

    /**
     * Check response status is NOT ok (field 'ok' === false)
     *
     * @return bool
     */
    public function isError()
    {
        return $this->get('ok', false) == false;
    }

    /**
     * Check response has warning
     *
     * @return bool
     */
    public function hasWarning()
    {
        return $this->has('warning');
    }

    /**
     * Return response warning message or empty string if not exists
     *
     * @return string
     */
    public function getWarning()
    {
        return $this->get('warning', '');
    }

    /**
     * Return response error message or empty string if not exists
     *
     * @return string
     */
    public function getError()
    {
        return $this->get('error', '');
    }
}
