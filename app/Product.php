<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    /**
	 * The attributes to be fillable from the model.
	 *
	 * A dirty hack to allow fields to be fillable by calling empty fillable array
	 *
	 * @var array
	 */
	protected $fillable = ['title', 'description', 'quantity', 'allow_order', 'pic_product', 'code', 'url1', 'url2', 'url3', 'twitter'];
    //protected $guarded = ['id'];
    
    public $timestamps = false;
}
