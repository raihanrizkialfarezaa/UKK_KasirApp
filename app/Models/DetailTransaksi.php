<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the comments for the DetailTransaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menu()
    {
        return $this->hasMany(Menu::class, 'id', 'id_menu');
    }
}
