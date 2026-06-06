<?php

declare(strict_types=1);

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Models\Post;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

/** @extends CreateRecord<Post>*/
class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['published']) {
            $data['published_at'] = Carbon::now();
        }

        return $data;
    }
}
