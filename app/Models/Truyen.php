<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truyen extends Model
{
    use HasFactory;

    protected $table = 'truyen';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['ten', 'slug', 'tomtat', 'hinhanh', 'danhmuc_id', 'tinhtrang'];

    public function danhmuc()
    {
        return $this->hasMany('App\Models\DanhMuc');
    }
}
