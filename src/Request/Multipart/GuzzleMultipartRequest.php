<?php

declare(strict_types=1);

namespace Nexus\ChatworkClient\Request\Multipart;

class GuzzleMultipartRequest
{
    public static function create(): self
    {
        return new self();
    }

    /**
     * @var array<mixed>
     */
    private $request;

    public function addContents(string $name, string $contents, array $header = []): self
    {
        $this->request = array_merge($this->request, [
            'name' => $name,
            'contents' => $contents,
            'header' => $header,
        ]);

        return $this;
    }

    public function addFileContents(string $name, string $filePath, string $fileName = null, array $header = []): self
    {
        $this->request = array_merge($this->request, [
            'name' => $name,
            'contents' => fopen($filePath, 'r'),
            'filename' => $fileName,
            'header' => $header,
        ]);

        return $this;
    }

    public function getResult(): array
    {
        return $this->request;
    }
}
