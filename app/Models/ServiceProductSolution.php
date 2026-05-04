<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProductSolution extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'heading',
        'sub_heading',
        'sort_order',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}