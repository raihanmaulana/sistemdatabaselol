<?php
  
namespace App\Models;
  

class tipe extends Model
{
    
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_tipe', 'nama_tipe','tipe_serangan'
    ];
    protected $primaryKey = 'id_tipe';
    protected $keyType = 'bigInteger';
    public $incrementing = false;

}