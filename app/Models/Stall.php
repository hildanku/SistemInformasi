<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'long',
        'lat',
        'status',
        'areaId',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'areaId');
    }
}
