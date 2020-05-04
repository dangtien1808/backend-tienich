<?php

class LabelNameModel extends Model
{
	//
	protected $tableName  = 'label-name';
	protected $primaryKey = 'id';
	protected $allowedFields = [
			'id',	'key',	'code',	'name',	'value'
	];

	protected $serveName = DB_SERVERNAME;
	protected $name = DB_2_NAME;
	protected $userName = DB_USERNAME;
	protected $password = DB_PASSWORD;
}