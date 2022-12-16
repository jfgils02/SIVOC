<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListaMateriales extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'id_project',
        'folio',
        'description',
        'modelo',
        'fabricante',
        'cantidad',
        'unidad'

    ];
}
