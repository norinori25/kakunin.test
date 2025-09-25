<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    public function category()
    {
    return $this->belongsTo(Category::class);
    }

    public function getFullNameAttribute()
    {
    return "{$this->last_name} {$this->first_name}";
    }

    public function getGenderLabelAttribute()
    {
        return match ($this->gender) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
            default => '不明',
        };
    }

}
