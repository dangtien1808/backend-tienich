<?php

class ManageLogModel extends Model
{
	protected $tableName  = 'manage-logs';
	protected $primaryKey = 'manage-id';
	protected $allowedFields = [
		'manage-id', 'create', 'menu-control','menu-action', 'new-data', 'old-data'
	];
}