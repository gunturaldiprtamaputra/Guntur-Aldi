<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    // Jika nama tabelmu bukan 'inventories', sebutkan di sini
    protected $table = 'inventories'; 
    
    // Jika kamu ingin mengizinkan pengisian data secara massal
    protected $fillable = ['kode_alat', 'nama_alat', 'stok', 'kategori'];
}