<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

#[Signature('app:verify-akismet-key')]
#[Description('Checks if the used akismet api key is valid.')]
final class VerifyAkismetKey extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $key = config('services.akismet.key');
        $url = config('app.url');

        $response = Http::asForm()->post('https://rest.akismet.com/1.1/verify-key', [
            'key' => $key,
            'blog' => $url,
        ])->body();

        $this->info($response);
    }
}
