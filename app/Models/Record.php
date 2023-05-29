<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        "image_path",
        "user_id",
        "debtor_id",
        "hasSoda",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function debtor()
    {
        return $this->belongsTo(User::class, "debtor_id");
    }
}
