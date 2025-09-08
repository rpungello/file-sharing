<?php

namespace App\Models;

use App\Observers\FileRequestObserver;
use Dyrynda\Database\Support\NullableFields;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(FileRequestObserver::class)]
class FileRequest extends Model
{
    use HasFactory, NullableFields, SoftDeletes;

    protected $fillable = [
        'user_id',
        'folder_id',
        'contact_id',
        'title',
        'description',
        'upload_token',
        'upload_short_url',
    ];

    protected array $nullable = [
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function getUploadUrl(): string
    {
        return route('requests.upload', [
            'fileRequest' => $this,
            'token' => $this->upload_token,
        ]);
    }
}
