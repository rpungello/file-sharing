<?php

namespace Database\Factories;

use App\Models\Download;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DownloadFactory extends Factory
{
    protected $model = Download::class;

    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'file_id' => File::factory(),
        ];
    }
}
