<?php

class ManageModel extends Model
{
	//
	protected $tableName  = 'manage';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'id', 'key', 'create', 'name', 
		'email', 'phone', 'password', 'images', 
		'status', 'root', 'department-id', 'menu-id', 'temp'
	];


}