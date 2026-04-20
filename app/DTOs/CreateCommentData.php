<?php

declare(strict_types=1);

namespace App\DTOs;

final class CreateCommentData
{
    public function __construct(
        public readonly string $body,
        public readonly ?string $email,
    ) {}

    /** @return array<string, string|null> */
    public function toArray(): array
    {
        return [
            'body' => $this->body,
            'email' => $this->email,
        ];
    }

    /** @param array{body: string, email: string|null} $data */
    public static function fromArray(array $data): self
    {
        return new self(
            body: $data['body'],
            email: $data['email']
        );
    }
}
