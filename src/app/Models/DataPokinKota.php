<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPokinKota extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
        });
    }

    protected $casts = [
        'indikator' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pokin_kota(): BelongsTo
    {
        return $this->belongsTo(PokinKota::class);
    }
}
