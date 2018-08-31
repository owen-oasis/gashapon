<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GashaponPrize extends Model
{
	protected $table = 'gashapon_prizes';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['prize', 'cardinality', 'inventory'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
