<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\AkismetContext;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory as HttpClient;
use Psr\Log\LoggerInterface;

final class CheckIfSpam
{
    public function __construct(
        protected HttpClient $http,
        protected LoggerInterface $logger,
    ) {}

    public function handle(AkismetContext $context, string $content): bool
    {
        try {
            $response = $this->http->asForm()->post('https://rest.akismet.com/1.1/comment-check', [
                'api_key' => config('services.akismet.key'),
                'blog' => config('app.url'),
                'user_ip' => $context->userIp,
                'user_agent' => $context->userAgent,
                'referrer' => $context->referrer,
                'comment_type' => 'comment',
                'comment_content' => $content,
                'blog_lang' => 'en',
                'blog_charset' => 'UTF-8',
            ]);
        } catch (ConnectionException $e) {
            $this->logger->warning('Akismet unreachable', ['error' => $e->getMessage()]);

            return false;
        }

        if ($response->failed()) {
            $this->logger->warning('Akismet check failed', ['status' => $response->status()]);

            return false;
        }

        $this->logger->info('Akismet response: ', ['body' => $response->body(), 'status' => $response->status()]);

        return $response->body() === 'true';
    }
}
