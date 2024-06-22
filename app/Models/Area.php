<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'areaName',
        'areaFacilities',
    ];
}
