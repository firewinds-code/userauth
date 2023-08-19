<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentData extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'agent_cti';

    protected $fillable = [
        'call_disposition',
        'call_back',
        'remarks',
    ]; 
}
