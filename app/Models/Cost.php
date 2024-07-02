<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'rentalCost',
        'areaId',
    ];
    public function area()
    {
        return $this->belongsTo(Area::class, 'areaId');
    }
}
