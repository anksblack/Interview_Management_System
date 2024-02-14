<?php

namespace App\Policies;

use App\Models\Interview;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InterviewPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Interview $interview)
    {
        // Assuming 'Interview' is the entity name used in permissions
        return $user->hasPermission("Interview", "view");
    }

    public function create(User $user)
    {
        return $user->hasPermission("Interview", "create");
    }

    public function update(User $user, Interview $interview)
    {
        return $user->hasPermission("Interview", "update");
    }

    public function handle(User $user, Interview $interview)
    {
        return $user->hasPermission("Interview", "handle");
    }

    public function delete(User $user, Interview $interview)
    {
        return $user->hasPermission("Interview", "delete");
    }

    public function restore(User $user, Interview $interview)
    {
        // Assuming you have a soft delete mechanism and a restore permission
        return $user->hasPermission("Interview", "restore");
    }

    public function destroy(User $user, Interview $interview)
    {
        // If you have a separate permission for permanently deleting
        return $user->hasPermission("Interview", "destroy");
    }

    public function schedule(User $user, Interview $interview)
    {
        // Assuming you need a permission to schedule an interview
        return $user->hasPermission("Interview", "schedule");
    }

    public function cancel(User $user, Interview $interview)
    {
        // Assuming you need a permission to cancel a scheduled interview
        return $user->hasPermission("Interview", "cancel");
    }
}
