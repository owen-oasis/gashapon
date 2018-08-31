<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GashaponHistory extends Model
{
	protected $table = 'gashapon_histories';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['phone', 'prize', 'ip'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
