<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    public $timestamps = false;
    protected $guarded = array('id');

    protected $fillable = ['id_user', 'id_order', 'product', 'shipping', 'value', 'created_date', 'status'];

    public static function postOrder(){

        $result = self::select('id','email','name', 'created_date', 'status')
                ->orderBy('id', 'asc')
                ->get();

        return $result;
    }
}
