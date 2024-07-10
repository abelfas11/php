<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'cnt_testing_jurusan';
    public $timestamps = false;
    protected $hidden = [] ;
    protected $fillable = [
        'name',
        'deskripsi',
    ];
}