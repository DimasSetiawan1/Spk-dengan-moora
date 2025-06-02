<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;
    protected $guarded = ['id', 'skor'];

    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class, 'kriteria_supplier')->withPivot('bobot', 'subkriteria_id')->withTimestamps();
    }
}
