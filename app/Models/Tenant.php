<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'domain',
    ];

    public function details()
    {
        return $this->hasOne(InvitationDetail::class);
    }
}
