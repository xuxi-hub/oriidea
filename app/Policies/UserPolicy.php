<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // 对用户授权策略添加 update 方法，用于用户更新时的权限验证。
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    // 对用户授权策略添加 destroy 方法，用于管理员执行删除操作。
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
