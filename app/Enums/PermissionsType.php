<?php

namespace App\Enums;

enum PermissionsType: string
{

    // tenants reviews
    case tenants_show = 'tenants_show';
    case tenants_edit = 'tenants_edit';
    case tenants_delete = 'tenants_delete';
    case tenants_create = 'tenants_create';

    // users reviews
    case users_show = 'users_show';
    case users_edit = 'users_edit';
    case users_delete = 'users_delete';
    case users_create = 'users_create';

    // roles reviews
    case roles_show = 'roles_show';
    case roles_edit = 'roles_edit';
    case roles_delete = 'roles_delete';
    case roles_create = 'roles_create';
}
