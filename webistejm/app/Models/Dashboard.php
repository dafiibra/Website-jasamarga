<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $fillable = ['area', 'total_findings', 'verified_findings', 'accuracy', 'precision', 'recall'];
}