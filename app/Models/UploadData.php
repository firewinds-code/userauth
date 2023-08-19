<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadData extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'upload_data';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cusid',
    ]; 
}


