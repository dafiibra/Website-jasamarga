<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHasilDeteksi extends Model
{
    use HasFactory;

    protected $table = 'data_hasil_deteksi';
    protected $primaryKey = 'id_deteksi';
    protected $fillable = [
        'image_url',
        'latlong',
        'is_valid',
        'area',
        'validated_by',
        'id_inspeksi',
        'repair_progress',
        'fifty_pct_image_url',
        'onehud_pct_image_url',
    ];
    
    public function inspeksi()
    {
        return $this->belongsTo(Inspeksi::class, 'id_inspeksi', 'id_inspeksi');
    }
}
