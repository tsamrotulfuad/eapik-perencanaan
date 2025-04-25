<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PohonKinerja extends Model
{
    use HasFactory;
    use HasUlids;

    protected $guarded = [];

    protected static function booted() 
    {
        parent::boot();

        static::creating(function($model) {
            $model->user_id = Auth::user()->id;
        });

        static::updating(function ($model) {
            if ($model->isDirty('file') && ($model->getOriginal('file') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('file'));
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
