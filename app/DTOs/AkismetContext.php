<?php

namespace App\DTOs;

use Illuminate\Http\Request;

final class AkismetContext
{
    public function __construct(
        public readonly string $userIp,
        public readonly string $userAgent,
        public readonly string $referrer
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            userIp: $request->ip() ?? '',
            userAgent: $request->userAgent() ?? '',
            referrer: $request->headers->get('referer') ?? '',
        );
    }
}
