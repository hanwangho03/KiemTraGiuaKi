<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocPhan extends Model
{
    use HasFactory;

    protected $table = 'hocphan';
    protected $primaryKey = 'MaHP';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['MaHP', 'TenHP', 'SoTinChi'];

    public function chiTietDangKy()
    {
        return $this->hasMany(ChiTietDangKy::class, 'MaHP', 'MaHP');
    }
}

