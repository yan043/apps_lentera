<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesPermissionsModel extends Model
{
    protected $table = 'tb_roles_permissions';

    protected $fillable = ['name'];
}
