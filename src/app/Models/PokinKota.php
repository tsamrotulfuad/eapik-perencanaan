<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PokinKota extends Model
{
    use HasFactory;

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

    public function data_pokin() : HasOne 
    {
        return $this->hasOne(DataPokinKota::class);
    }
}
