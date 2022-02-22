<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'site_id'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
