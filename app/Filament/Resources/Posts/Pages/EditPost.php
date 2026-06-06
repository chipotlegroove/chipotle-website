<?php

declare(strict_types=1);

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Models\Post;
use Carbon\Carbon;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

/** @extends EditRecord<Post> */
class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['published'] && $this->record->published_at === null) {
            $data['published_at'] = Carbon::now();
        }

        return $data;
    }
}
