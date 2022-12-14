<?php
  
namespace App\Models;
  

  
class Hero extends Model
{
    
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_hero', 'nama_hero','id_tipe','id_posisi'
    ];
    protected $primaryKey = 'id_hero';
    protected $keyType = 'bigInteger';
    public $incrementing = false;
}