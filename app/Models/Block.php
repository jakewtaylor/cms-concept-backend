<?php

namespace App\Models;

use App\Enum\BlockType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'type', 'content', 'site_id'];

    protected $casts = [
        'type' => BlockType::class,
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
