<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Check if a tenant is resolved and apply the tenant_id constraint
        if (app()->has('tenant')) {
            $tenantId = app('tenant')->id; // Retrieve current tenant's ID
            $builder->where('tenant_id', $tenantId);
        }
    }
}
