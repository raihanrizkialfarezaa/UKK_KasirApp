<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the comments for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_menu', 'id');
    }
}
