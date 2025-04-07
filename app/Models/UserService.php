<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserService extends Model
{
    protected $table = 'user_services';

    protected $fillable = ['user_id', 'user_address_id', 'platform_service_id', 'name', 'description','price','order', 'is_active'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo {
        return $this->belongsTo(UserAddress::class, 'user_address_id');
    }

    public function platformService(): BelongsTo {
        return $this->belongsTo(PlatformService::class);
    }
}
