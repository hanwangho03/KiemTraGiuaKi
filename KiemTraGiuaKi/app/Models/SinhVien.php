<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SinhVien extends Authenticatable
{
    use HasFactory;

    protected $table = 'sinhvien';
    protected $primaryKey = 'MaSV';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['MaSV', 'HoTen', 'GioiTinh', 'NgaySinh', 'Hinh', 'MaNganh'];

    public function nganhHoc()
    {
        return $this->belongsTo(NganhHoc::class, 'MaNganh', 'MaNganh');
    }

    public function dangKys()
    {
        return $this->hasMany(DangKy::class, 'MaSV', 'MaSV');
    }
}

