<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Route;

class Calendar extends Model
{

    use HasFactory;

    protected $table = 'calendar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function getRoutes($date_init, $date_finish, $date)
    {
        $functions = [];
        if ($date_init && $date_finish) {
            $functions['range'] = function ($query) use ($date_init, $date_finish) {
                $query->where([
                    ['date_init', '>=', $date_init],
                    ['date_finish', '<=', $date_finish],
                ])->orWhere([
                    ['date_init', '<=', $date_init],
                    ['date_finish', '>=', $date_finish],
                ]);
            };
        }
        if ($date){
            $functions['date'] = function ($query) use ($date) {
                $query->where('date_init', '<=', $date)
                      ->where('date_finish', '>=', $date);
            };
        }

        $routes = Route::where('calendar_id', $this->id);

        foreach ($functions as $function) {
            $routes->where($function);
        }

        $routes = $routes->get();

        return $routes;
    }
}
