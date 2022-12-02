<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class posisi extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_posisi', 'nama_posisi'
    ];
    protected $primaryKey = 'id_posisi';
    protected $keyType = 'bigInteger';
    public $incrementing = false;

}