<?php
declare(strict_types=1);

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ProjectPolicy
 * @package App\Policies
 */
class ProjectPolicy
{
    use HandlesAuthorization;


    /**
     * @param User $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }


    /**
     * Determine whether the user can view any projects.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }


    /**
     * Determine whether the user can view the project.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }


    /**
     * Determine whether the user can create projects.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }


    /**
     * Determine whether the user can update the project.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }


    /**
     * Determine whether the user can delete the project.
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }
}
