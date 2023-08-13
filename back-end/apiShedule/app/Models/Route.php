<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Reservation;

class Route extends Model
{
    use HasFactory;

    protected $table = 'route';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];


    public function getReservations(){
        return Reservation::where('route_id', $this->id)->get();
    }

    public function setReservation($reservation){
        $route = Route::where('id', $this->id).first();
        $dias_deshabilitados = [];
        if($route->mon == 1){
            $dias_deshabilitados['mon'] = true;
        }
    }
}
