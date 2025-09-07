<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Download extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file_id',
        'ip_address',
        'user_agent',
    ];

    public function file(): BelongsTo
    {
        return $this->belongsTo(File::class);
    }
}
