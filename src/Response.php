<?php

namespace Lkt\Http;

use Lkt\Http\Traits\ContentTypeTrait;

class Response
{
    use ContentTypeTrait;

    protected int $code = 1;
    protected array|string $responseData = [];

    protected int $headerCacheControlMaxAge = -1;
    protected int $headerExpires = -1;
    protected int $headerLastModified = -1;

    protected string $headerContentDisposition = '';

    public function __construct(int $code = 1, array|string $responseData = [])
    {
        $this->code = $code;
        $this->responseData = $responseData;

        if (is_string($responseData)) {
            $this->setContentTypeTextHTML();
        }
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setResponseData(array $responseData): static
    {
        $this->responseData = $responseData;
        return $this;
    }

    public function getResponseData(): array|string
    {
        return $this->responseData;
    }

    public function setCacheControlMaxAgeHeader(int $time): static
    {
        $this->headerCacheControlMaxAge = $time;
        return $this;
    }

    public function setCacheControlMaxAgeHeaderToOneDay(): static
    {
        $this->headerCacheControlMaxAge = 86400;
        return $this;
    }

    public function setCacheControlMaxAgeHeaderToOneWeek(): static
    {
        $this->headerCacheControlMaxAge = 604800;
        return $this;
    }

    public function setCacheControlMaxAgeHeaderToOneMonth(): static
    {
        $this->headerCacheControlMaxAge = 2419200;
        return $this;
    }

    public function setCacheControlMaxAgeHeaderToOneYear(): static
    {
        $this->headerCacheControlMaxAge = 31536000;
        return $this;
    }

    public function setExpiresHeader(int $time): static
    {
        $this->headerExpires = $time;
        return $this;
    }

    public function setExpiresHeaderToOneDay(): static
    {
        $this->headerExpires = 86400;
        return $this;
    }

    public function setExpiresHeaderToOneWeek(): static
    {
        $this->headerExpires = 604800;
        return $this;
    }

    public function setExpiresHeaderToOneMonth(): static
    {
        $this->headerExpires = 2419200;
        return $this;
    }

    public function setExpiresHeaderToOneYear(): static
    {
        $this->headerExpires = 31536000;
        return $this;
    }

    public function setLastModifiedHeader(int $time): static
    {
        $this->headerLastModified = $time;
        return $this;
    }

    public function setContentDispositionAttachment(string $filename): static
    {
        $this->headerContentDisposition = 'attachment; filename="' . $filename . '"';
        return $this;
    }

    public function sendHeaders(): static
    {
        $this->sendStatusHeader();
        $this->sendContentTypeHeader();

        if ($this->headerCacheControlMaxAge > -1) {
            header("Cache-control: max-age={$this->headerCacheControlMaxAge}");
        }

        if ($this->headerExpires > -1) {
            header('Expires: ' . gmdate(DATE_RFC1123, time() + $this->headerExpires));
        }

        if ($this->headerLastModified > -1) {
            header('Last-Modified: ' . gmdate(DATE_RFC1123, $this->headerLastModified));
        }

        if ($this->headerContentDisposition !== '') {
            header("Content-Disposition: {$this->headerContentDisposition}");
        }

        return $this;
    }

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

    public static function status(int $code = 200, array|string $responseData = []): static
    {
        return new static($code, $responseData);
    }

    public static function ok(array|string $responseData = []): static
    {
        return static::status(200, $responseData);
    }

    public static function created(array|string $responseData = []): static
    {
        return static::status(201, $responseData);
    }

    public static function accepted(array|string $responseData = []): static
    {
        return static::status(202, $responseData);
    }

    public static function noContent(array|string $responseData = []): static
    {
        return static::status(204, $responseData);
    }

    public static function multipleChoices(array|string $responseData = []): static
    {
        return static::status(300, $responseData);
    }

    public static function movedPermanently(array|string $responseData = []): static
    {
        return static::status(301, $responseData);
    }

    public static function found(array|string $responseData = []): static
    {
        return static::status(302, $responseData);
    }

    public static function seeOther(array|string $responseData = []): static
    {
        return static::status(303, $responseData);
    }

    public static function notModified(array|string $responseData = []): static
    {
        return static::status(304, $responseData);
    }

    public static function badRequest(array|string $responseData = []): static
    {
        return static::status(400, $responseData);
    }

    public static function unauthorized(array|string $responseData = []): static
    {
        return static::status(401, $responseData);
    }

    public static function forbidden(array|string $responseData = []): static
    {
        return static::status(403, $responseData);
    }

    public static function notFound(array|string $responseData = []): static
    {
        return static::status(404, $responseData);
    }

    public static function methodNotAllowed(array|string $responseData = []): static
    {
        return static::status(405, $responseData);
    }

    public static function internalServerError(array|string $responseData = []): static
    {
        return static::status(500, $responseData);
    }

    public static function notImplemented(array|string $responseData = []): static
    {
        return static::status(501, $responseData);
    }

    public static function badGateway(array|string $responseData = []): static
    {
        return static::status(502, $responseData);
    }

    public static function serviceUnavailable(array|string $responseData = []): static
    {
        return static::status(503, $responseData);
    }
}