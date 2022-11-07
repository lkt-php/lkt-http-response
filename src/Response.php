<?php

namespace Lkt\Http;

class Response
{
    protected $code;
    protected $responseData = [];

    /**
     * @param int $code
     * @param array $responseData
     */
    public function __construct(int $code = 1, array $responseData = [])
    {
        $this->code = $code;
        $this->responseData = $responseData;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param array $responseData
     * @return $this
     */
    public function setResponseData(array $responseData): self
    {
        $this->responseData = $responseData;
        return $this;
    }

    /**
     * @return array
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }

    /**
     * @return bool
     */
    public function sendStatusHeader(): bool
    {
        $protocol = $_SERVER['SERVER_PROTOCOL'];

        if ($this->code === 200) {
            header("{$protocol} {$this->code} OK");
            return true;
        }

        if ($this->code === 201) {
            header("{$protocol} {$this->code} Created");
            return true;
        }

        if ($this->code === 202) {
            header("{$protocol} {$this->code} Accepted");
            return true;
        }

        if ($this->code === 204) {
            header("{$protocol} {$this->code} No Content");
            return true;
        }

        if ($this->code === 300) {
            header("{$protocol} {$this->code} Multiple Choices");
            return true;
        }

        if ($this->code === 301) {
            header("{$protocol} {$this->code} Moved Permanently");
            return true;
        }

        if ($this->code === 302) {
            header("{$protocol} {$this->code} Found");
            return true;
        }

        if ($this->code === 303) {
            header("{$protocol} {$this->code} See Other");
            return true;
        }

        if ($this->code === 304) {
            header("{$protocol} {$this->code} Not Modified");
            return true;
        }

        if ($this->code === 400) {
            header("{$protocol} {$this->code} Bad Request");
            return false;
        }

        if ($this->code === 401) {
            header("{$protocol} {$this->code} Unauthorized");
            return false;
        }

        if ($this->code === 403) {
            header("{$protocol} {$this->code} Forbidden");
            return false;
        }

        if ($this->code === 404) {
            header("{$protocol} {$this->code} Not Found");
            return false;
        }

        if ($this->code === 405) {
            header("{$protocol} {$this->code} Method Not Allowed");
            return false;
        }

        if ($this->code === 500) {
            header("{$protocol} {$this->code} Internal Server Error");
            return false;
        }

        if ($this->code === 501) {
            header("{$protocol} {$this->code} Not Implemented");
            return false;
        }

        if ($this->code === 502) {
            header("{$protocol} {$this->code} Bad Gateway");
            return false;
        }

        if ($this->code === 503) {
            header("{$protocol} {$this->code} Service Unavailable");
            return false;
        }
        return false;
    }

    /**
     * @param int $code
     * @param array $responseData
     * @return static
     */
    public static function status(int $code = 200, array $responseData = []): self
    {
        return new static($code, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function ok(array $responseData = []): self
    {
        return static::status(200, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function created(array $responseData = []): self
    {
        return static::status(201, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function accepted(array $responseData = []): self
    {
        return static::status(202, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function noContent(array $responseData = []): self
    {
        return static::status(204, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function multipleChoices(array $responseData = []): self
    {
        return static::status(300, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function movedPermanently(array $responseData = []): self
    {
        return static::status(301, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function found(array $responseData = []): self
    {
        return static::status(302, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function seeOther(array $responseData = []): self
    {
        return static::status(303, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function notModified(array $responseData = []): self
    {
        return static::status(304, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function badRequest(array $responseData = []): self
    {
        return static::status(400, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function unauthorized(array $responseData = []): self
    {
        return static::status(401, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function forbidden(array $responseData = []): self
    {
        return static::status(403, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function notFound(array $responseData = []): self
    {
        return static::status(404, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function methodNotAllowed(array $responseData = []): self
    {
        return static::status(405, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function internalServerError(array $responseData = []): self
    {
        return static::status(500, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function notImplemented(array $responseData = []): self
    {
        return static::status(501, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function badGateway(array $responseData = []): self
    {
        return static::status(502, $responseData);
    }

    /**
     * @param array $responseData
     * @return static
     */
    public static function serviceUnavailable(array $responseData = []): self
    {
        return static::status(503, $responseData);
    }
}