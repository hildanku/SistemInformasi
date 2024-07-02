<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $fillable = [
        'rentDate',
        'returnDate',
        'stallId',
        'userId',
        'costId',
        'status',
    ];
    public function area()
    {
        return $this->belongsTo(Area::class, 'areaId');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function stall()
    {
        return $this->belongsTo(Stall::class, 'stallId');
    }
    public function cost()
    {
        return $this->belongsTo(Cost::class, 'costId');
    }
}
