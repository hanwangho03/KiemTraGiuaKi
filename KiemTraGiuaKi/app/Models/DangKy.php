<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DangKy extends Model
{
    use HasFactory;

    protected $table = 'dangky';
    protected $primaryKey = 'MaDK';
    public $timestamps = false;

    protected $fillable = ['NgayDK', 'MaSV'];

    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'MaSV', 'MaSV');
    }

    public function chiTietDangKys()
    {
        return $this->hasMany(ChiTietDangKy::class, 'MaDK', 'MaDK');
    }
}