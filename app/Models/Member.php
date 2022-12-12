<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'parent_id',
        'name',
        'level'
    ];

    public function parent()
    {
        return $this->belongsTo(Self::class, 'parent_id', 'id');
    }
    
    public function parents()
    {
        return $this->parent()->with('parents');
    }

    public function children()
    {
        return $this->hasMany(Self::class, 'parent_id', 'id');
    }

    public function childrens()
    {
        return $this->children()->with('childrens');
    }
}
