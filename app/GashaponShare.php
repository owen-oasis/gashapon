<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GashaponShare extends Model
{
	protected $table = 'gashapon_shares';
	protected $primarykey = 'id';
	public $timestamps = true;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['phone', 'share_status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
