<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;

class InvitationDetail extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function booted()
    {
        static::addGlobalScope(new TenantScope());
    }
}
