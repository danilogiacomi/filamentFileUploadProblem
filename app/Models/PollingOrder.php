<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PollingOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function files(): HasMany
    {
        return $this->hasMany(PollingOrderFile::class);
    }
}
