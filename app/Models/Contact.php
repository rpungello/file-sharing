<?php

namespace App\Models;

use Dyrynda\Database\Support\NullableFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes, NullableFields;

    protected $fillable = [
        'user_id',
        'name',
        'company',
        'email',
    ];

    protected array $nullable = [
        'company',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
