<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NganhHoc extends Model
{
    use HasFactory;

    protected $table = 'nganhhoc';
    protected $primaryKey = 'MaNganh';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['MaNganh', 'TenNganh'];

    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'MaNganh', 'MaNganh');
    }
}

