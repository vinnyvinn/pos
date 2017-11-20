<?php
use SmoDav\Models\UserGroup;

function flash($message, $status = 'info')
{
    session()->flash('flash_message', $message);
    session()->flash('flash_status', $status);
}
function hasPermission($permission)
{
    if (Auth::guest()) {
        return false;
    }

    if (Auth::user()->user_group_id == 1) {
        return true;
    }

    $roleId = Auth::user()->user_group_id;

    if ($roleId == 0) {
        return true;
    }

    $rolePermissions = json_decode(getRole($roleId)->permissions);

    return in_array($permission, $rolePermissions);
}
function getRole($roleId)
{
    if (! Cache::has(UserGroup::CACHE_KEY)) {
        recacheRoles();
    }

    return Cache::get(UserGroup::CACHE_KEY)
        ->where('id', $roleId)
        ->first();
}

function recacheRoles()
{
    Cache::forget(UserGroup::CACHE_KEY);
    Cache::rememberForever(UserGroup::CACHE_KEY, function () {
        return UserGroup::all(['name', 'id', 'permissions']);
    });
}
