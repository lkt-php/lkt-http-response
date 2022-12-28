<?php

namespace Lkt\Http\Traits;

use Lkt\Http\Enums\ContentType;

trait ContentTypeTrait
{
    use CharsetTrait;

    protected string $contentType = ContentType::JSON;

    public function setContentTypeJSON(): static
    {
        $this->contentType = ContentType::JSON;
        return $this;
    }

    public function setContentTypeTextHTML(): static
    {
        $this->contentType = ContentType::TEXT_HTML;
        return $this;
    }

    public function isJSONContentType(): bool
    {
        return $this->contentType === ContentType::JSON;
    }

    public function sendContentTypeHeader(): bool
    {
        $contentType = $this->contentType;
        $charset = $this->charset;

        $aux = [$contentType];
        if ($charset !== '') {
            $aux[] = "charset={$charset}";
        }
        $header = implode(';', $aux);

        header("Content-Type: {$header}");

        return true;
    }

    public function sendJSONContent(): static
    {
        if ($this->isJSONContentType()) {
            echo json_encode($this->getResponseData());
        }
        return $this;
    }
}