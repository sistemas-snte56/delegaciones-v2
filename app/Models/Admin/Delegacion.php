<?php

namespace App\Models\Admin;

use App\Models\Admin\Region;
use App\Models\Admin\Nomenclatura;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delegacion extends Model
{
    use HasFactory;
    protected $table = "delegaciones";
    protected $fillable = [
        'id_region',
        'id_tipo_delegacion',
        'id_delegacion_o_ct',
        'id_nomenclatura',
        'num_delegaciona',
        'nivel_delegaciona',
        'sede_delegaciona',
        'fecha_inicio_delegaciona',
        'fecha_final_delegaciona',
        'direccion_delegaciona',
        'cp_delegaciona',
        'ciudad_delegaciona',
        'estado_delegaciona',        
    ];

    /**
     * Get the region that owns the Delegacion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'id');
    }

    public function nomenclatura()
    {
        return $this->belongsTo(Nomenclatura::class, 'id_nomenclatura', 'id');
    }   
    
    
    // public function users()
    // {
    //     return $this->hasMany(User::class, 'id_delegacion');
    // }    

    // public function maestros()
    // {
    //     return $this->hasMany(Maestro::class, 'id_delegacion');
    // }    
}
