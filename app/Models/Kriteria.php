<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    /** @use HasFactory<\Database\Factories\KriteriaFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class);
    }
}
