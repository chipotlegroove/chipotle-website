<?php

namespace App\DTOs;

final class CreateCommentData
{
    public function __construct(
        public readonly string $body,
    ) {}

    /** @return array<string, string> */
    public function toArray(): array
    {
        return [
            'body' => $this->body,
        ];
    }

    /** @param array{body: string} $data */
    public static function fromArray(array $data): self
    {
        return new self(
            body: $data['body']
        );
    }
}
