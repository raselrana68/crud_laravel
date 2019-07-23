<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{   
    use SoftDeletes;
    protected $fillable =['product_image','product_name','product_description','product_price','product_quantity','alert_quantity'];
}
