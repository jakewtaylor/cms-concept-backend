<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'organization_id',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
