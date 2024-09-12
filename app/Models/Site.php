<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'name',
        'phone_number',
        'email',
        'open_time',
        'close_time',
        'capacity',
        'manager_name'
    ];

    public function trucks():HasMany{
       return $this->hasMany(Truck::class);
    }
}
