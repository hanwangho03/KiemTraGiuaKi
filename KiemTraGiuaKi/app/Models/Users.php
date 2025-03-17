<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $table = 'sinhvien';
    protected $primaryKey = 'MaSV';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MaSV', 'HoTen', 'GioiTinh', 'NgaySinh', 'Hinh', 'MaNganh', 'password'];

    protected $hidden = ['password'];

    public function getAuthPassword()
    {
        return $this->password;
    }
}
