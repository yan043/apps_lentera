<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthModel extends Authenticatable
{
    protected $table = 'tb_employee';

    protected $fillable = [
        'regional_id',
        'witel_id',
        'mitra_id',
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
}
