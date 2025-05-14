<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoSo extends Model
{
    protected $connection = 'mysql';

    protected $table = 'ho_so';
    protected $primaryKey = 'ma_ho_so';
    protected $fillable = [
        'ma_ho_so',
        'ho_ten',
        'so_cccd',
        'so_dien_thoai',
        'noi_thuong_tru',
        'email',
        'file_name',
        'file_path',
    ];
}
