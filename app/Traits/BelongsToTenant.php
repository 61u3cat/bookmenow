<?php

namespace App\Traits;

use App\Models\Tenant;
use App\Scopes\TenantScope;
use Illuminate\Support\Facades\Auth;

trait BelongsToTenant
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    protected static function bootBelongsToTenant()
    {
        static::addGlobalScope(new TenantScope());

        static::creating(function ($model) {
            if (!$model->tenant_id) { // Only assign if it's not already set
                if (Auth::hasUser() && Auth::user()->tenant_id) {
                    $model->tenant_id = Auth::user()->tenant_id;
                } elseif ($model->service && $model->service->tenant_id) {
                    $model->tenant_id = $model->service->tenant_id;
                }
            }
        });
    }

    /**
     * Get the tenant that owns the model.
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    /**
     * Get the fully qualified "tenant id" column.
     *
     * @return string
     */
    public function getQualifiedTenantIdColumn()
    {
        return $this->getTable() . '.tenant_id';
    }
}
