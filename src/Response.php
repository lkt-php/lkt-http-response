<?php

namespace Lkt\Http;

use Lkt\Http\Traits\ContentTypeTrait;

class Response
{
    use ContentTypeTrait;

    protected int $code = 1;
    protected array $responseData = [];

    protected int $headerCacheControlMaxAge = -1;
    protected int $headerExpires = -1;

    public function __construct(int $code = 1, array $responseData = [])
    {
        $this->code = $code;
        $this->responseData = $responseData;
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

    public function getResponseData(): array
    {
        return $this->responseData;
    }

    public function setHeaderCacheControlMaxAge(int $time): static
    {
        $this->headerCacheControlMaxAge = $time;
        return $this;
    }

    public function setHeaderCacheControlMaxAgeToOneDay(): static
    {
        $this->headerCacheControlMaxAge = 86400;
        return $this;
    }

    public function setHeaderCacheControlMaxAgeToOneWeek(): static
    {
        $this->headerCacheControlMaxAge = 604800;
        return $this;
    }

    public function setHeaderCacheControlMaxAgeToOneMonth(): static
    {
        $this->headerCacheControlMaxAge = 2419200;
        return $this;
    }

    public function setHeaderCacheControlMaxAgeToOneYear(): static
    {
        $this->headerCacheControlMaxAge = 31536000;
        return $this;
    }

    public function setHeaderExpires(int $time): static
    {
        $this->headerExpires = $time;
        return $this;
    }

    public function setHeaderExpiresToOneDay(): static
    {
        $this->headerExpires = 86400;
        return $this;
    }

    public function setHeaderExpiresToOneWeek(): static
    {
        $this->headerExpires = 604800;
        return $this;
    }

    public function setHeaderExpiresToOneMonth(): static
    {
        $this->headerExpires = 2419200;
        return $this;
    }

    public function setHeaderExpiresToOneYear(): static
    {
        $this->headerExpires = 31536000;
        return $this;
    }

    public function sendHeaders(): void
    {
        $this->sendStatusHeader();
        $this->sendContentTypeHeader();

        if ($this->headerCacheControlMaxAge > -1) {
            header("Cache-control: max-age={$this->headerCacheControlMaxAge}");
        }

        if ($this->headerExpires > -1) {
            header('Expires: ' . gmdate(DATE_RFC1123, time() + $this->headerExpires));
        }
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

    public static function status(int $code = 200, array $responseData = []): static
    {
        return new static($code, $responseData);
    }

    public static function ok(array $responseData = []): static
    {
        return static::status(200, $responseData);
    }

    public static function okTextHTML(string $html): static
    {
        $r = static::status(200, ['html' => $html]);
        $r->setContentTypeTextHTML();
        return $r;
    }

    public static function created(array $responseData = []): static
    {
        return static::status(201, $responseData);
    }

    public static function createdTextHTML(string $html): static
    {
        $r = static::status(201, ['html' => $html]);
        $r->setContentTypeTextHTML();
        return $r;
    }

    public static function accepted(array $responseData = []): static
    {
        return static::status(202, $responseData);
    }

    public static function acceptedTextHTML(string $html): static
    {
        $r = static::status(202, ['html' => $html]);
        $r->setContentTypeTextHTML();
        return $r;
    }

    public static function noContent(array $responseData = []): static
    {
        return static::status(204, $responseData);
    }

    public static function noContentTextHTML(string $html): static
    {
        $r = static::status(204, ['html' => $html]);
        $r->setContentTypeTextHTML();
        return $r;
    }

    public static function multipleChoices(array $responseData = []): static
    {
        return static::status(300, $responseData);
    }

    public static function movedPermanently(array $responseData = []): static
    {
        return static::status(301, $responseData);
    }

    public static function found(array $responseData = []): static
    {
        return static::status(302, $responseData);
    }

    public static function seeOther(array $responseData = []): static
    {
        return static::status(303, $responseData);
    }

    public static function notModified(array $responseData = []): static
    {
        return static::status(304, $responseData);
    }

    public static function badRequest(array $responseData = []): static
    {
        return static::status(400, $responseData);
    }

    public static function unauthorized(array $responseData = []): static
    {
        return static::status(401, $responseData);
    }

    public static function forbidden(array $responseData = []): static
    {
        return static::status(403, $responseData);
    }

    public static function notFound(array $responseData = []): static
    {
        return static::status(404, $responseData);
    }

    public static function methodNotAllowed(array $responseData = []): static
    {
        return static::status(405, $responseData);
    }

    public static function internalServerError(array $responseData = []): static
    {
        return static::status(500, $responseData);
    }

    public static function notImplemented(array $responseData = []): static
    {
        return static::status(501, $responseData);
    }

    public static function badGateway(array $responseData = []): static
    {
        return static::status(502, $responseData);
    }

    public static function serviceUnavailable(array $responseData = []): static
    {
        return static::status(503, $responseData);
    }
}