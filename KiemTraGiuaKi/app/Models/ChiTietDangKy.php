<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDangKy extends Model
{
    use HasFactory;

    protected $table = 'chitietdangky';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['MaDK', 'MaHP'];

    public function dangKy()
    {
        return $this->belongsTo(DangKy::class, 'MaDK', 'MaDK');
    }

    public function hocPhan()
    {
        return $this->belongsTo(HocPhan::class, 'MaHP', 'MaHP');
    }

    // ✅ Xử lý khóa chính kép thủ công
    protected function setKeysForSaveQuery($query)
    {
        return $query->where('MaDK', $this->getAttribute('MaDK'))
                     ->where('MaHP', $this->getAttribute('MaHP'));
    }
}
