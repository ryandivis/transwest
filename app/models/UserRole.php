<?php

class UserRole extends Eloquent {

	protected $table = 'user_roles';

	 protected $fillable = array(
    	'id',
    	'role',
    	'weight',
    	'business_required'
    );

}