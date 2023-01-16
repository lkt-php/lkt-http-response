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

    public function isTextHTMLContentType(): bool
    {
        return $this->contentType === ContentType::TEXT_HTML;
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
            $data = $this->getResponseData();
            if (count($data) > 0){
                echo json_encode($data);
            }
        }
        return $this;
    }

    public function sendTextHTMLContent(): static
    {
        if ($this->isTextHTMLContentType()) {
            $data = $this->getResponseData();
            if (count($data) > 0 && isset($data['html'])){
                echo $data['html'];
            }
        }
        return $this;
    }
}