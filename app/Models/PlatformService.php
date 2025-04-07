<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlatformService extends Model
{
    public function doctorServices(): HasMany {
        return $this->hasMany(PlatformService::class);
    }
}
