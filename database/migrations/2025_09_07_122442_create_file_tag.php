<?php

use App\Models\File;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('file_tag', function (Blueprint $table) {
            $table->foreignIdFor(File::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();

            $table->primary(['file_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_tag');
    }
};
