<?php

namespace Database\Factories;

use App\Models\FileRequest;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FileRequestFactory extends Factory
{
    protected $model = FileRequest::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'upload_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
            'folder_id' => Folder::factory(),
        ];
    }
}
