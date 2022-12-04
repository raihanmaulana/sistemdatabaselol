<?php
  
namespace App\Models;
  


class posisi extends Model
{

  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_posisi', 'nama_posisi', 'spell',
    ];
    protected $primaryKey = 'id_posisi';
    protected $keyType = 'bigInteger';
    public $incrementing = false;

}