<?php

namespace App\Observers;

use App\Models\Permissions;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class PermissionsObserver
{
    /**
     * Handle the Permissions "created" event.
     */
    public function created(Permissions $permissions): void
    {
        if (empty($permissions->slug)) {
            $slug = Str::slug($permissions->name, '-');
            $count = Permissions::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
            $permissions->slug = $count ? "{$slug}-{$count}" : $slug;
            $permissions->save();
            Log::info('PermissionObserver@creating is called', ['name' => $permissions->slug]);
        }
    }

    /**
     * Handle the Permissions "updated" event.
     */
    public function updated(Permissions $permissions): void
    {
        $originalSlug = $permissions->getOriginal('slug');

        // Kembalikan slug ke nilai aslinya jika ada percobaan untuk mengubahnya
        if ($permissions->slug !== $originalSlug) {
            $permissions->slug = $originalSlug;
        }
    }

    /**
     * Handle the Permissions "deleted" event.
     */
    public function deleted(Permissions $permissions): void
    {
        //
    }

    /**
     * Handle the Permissions "restored" event.
     */
    public function restored(Permissions $permissions): void
    {
        //
    }

    /**
     * Handle the Permissions "force deleted" event.
     */
    public function forceDeleted(Permissions $permissions): void
    {
        //
    }
}
