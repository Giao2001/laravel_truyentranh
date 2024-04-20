<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;
    protected $table = 'danhmuc';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['tendanhmuc', 'motadanhmuc', 'tinhtrang', 'slug_danhmuc'];
}
