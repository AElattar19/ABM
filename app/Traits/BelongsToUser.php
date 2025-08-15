<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;

trait BelongsToUser
{
    public static function bootBelongsToUser()
    {
        static::updating(function ($model) {
            if ($model->user_id !== auth()->id()) {
                throw new ModelNotFoundException("You do not own this record.");
            }
        });

        static::deleting(function ($model) {
            if ($model->user_id !== auth()->id()) {
                throw new ModelNotFoundException("You do not own this record.");
            }
        });
    }
}
