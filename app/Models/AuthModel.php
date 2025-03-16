<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthModel extends Authenticatable
{
    protected $table = 'tb_employee';

    protected $fillable = [
        'regional_id',
        'witel_id',
        'mitra_id',
        'unit_id',
        'sub_unit_id',
        'level_id',
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
        return self::with('level')
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

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id');
    }

    public static function profile($nik)
    {
        return DB::table('tb_employee AS te')
        ->leftJoin('tb_regional AS tr', 'te.regional_id', '=', 'tr.id')
        ->leftJoin('tb_witel AS tw', 'te.witel_id', '=', 'tw.id')
        ->leftJoin('tb_mitra AS tm', 'te.mitra_id', '=', 'tm.id')
        ->leftJoin('tb_unit AS tu', 'te.unit_id', '=', 'tu.id')
        ->leftJoin('tb_sub_unit AS tsu', 'te.sub_unit_id', '=', 'tsu.id')
        ->leftJoin('tb_level AS tl', 'te.level_id', '=', 'tl.id')
        ->select(
            'te.*',
            'tr.name AS regional_name',
            'tw.name AS witel_name',
            'tm.name AS mitra_name',
            'tu.name AS unit_name',
            'tsu.name AS sub_unit_name',
            'tl.name AS level_name'
        )
        ->where([
            'te.nik'       => $nik,
            'te.is_active' =>  1
        ])
        ->first();
    }
}
