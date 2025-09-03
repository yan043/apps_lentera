<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\RolesPermissionsModel;

class AuthModel extends Authenticatable
{
    protected $table = 'tb_employee';

    protected $fillable = [
        'regional_id',
        'witel_id',
        'mitra_id',
        'sub_unit_id',
        'sub_group_id',
        'role_id',
        'nik',
        'full_name',
        'chat_id',
        'number_phone',
        'home_address',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'remember_token',
        'google2fa_secret',
        'password',
        'ip_address',
        'login_at',
        'is_active',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    protected $hidden = [
        'password',
        'google2fa_secret',
        'remember_token',
    ];

    public static function identity(string $nik): ?self
    {
        return self::with('role')
            ->where('nik', $nik)
            ->first();
    }

    public static function set_token(string $nik, string $token, string $ip_address): bool
    {
        $user = self::where('nik', $nik)->first();

        if (!$user)
        {
            return false;
        }

        $user->update([
            'remember_token' => $token,
            'ip_address'     => $ip_address,
            'login_at'       => Carbon::now(),
        ]);

        return true;
    }

    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getAuthIdentifierName(): string
    {
        return 'nik';
    }

    public function role()
    {
        return $this->belongsTo(RolesPermissionsModel::class, 'role_id');
    }

    public static function profile($id)
    {
        return DB::table('tb_employee AS te')
        ->leftJoin('tb_regional AS tr', 'te.regional_id', '=', 'tr.id')
        ->leftJoin('tb_witel AS tw', 'te.witel_id', '=', 'tw.id')
        ->leftJoin('tb_mitra AS tm', 'te.mitra_id', '=', 'tm.id')
        ->leftJoin('tb_sub_unit AS tsu', 'te.sub_unit_id', '=', 'tsu.id')
        ->leftJoin('tb_sub_group AS tsg', 'te.sub_group_id', '=', 'tsg.id')
        ->leftJoin('tb_roles_permissions AS trp', 'te.role_id', '=', 'trp.id')
        ->select(
            'te.*',
            'tr.name AS regional_name',
            'tw.name AS witel_name',
            'tw.alias AS witel_alias',
            'tm.name AS mitra_name',
            'tsu.name AS sub_unit_name',
            'tsg.name AS sub_group_name',
            'trp.name AS role_name'
        )
        ->where([
            'te.id'        => $id,
            'te.is_active' => 1
        ])
        ->first();
    }
}
