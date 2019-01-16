<?php

use Illuminate\Database\Capsule\Manager as Capsule;

//define ('NORMAL_TYPE', 0);
//define ('SUM_TYPE', 0);
//define ('AVG_TYPE', 0);
//define ('COUNT_TYPE', 0);

/**
* class for building query
*/
class queryBuilder
{
	protected $columns;
	protected $params;
	protected $table;
	protected $builder;

	
	public function __construct($table, $columns = null , $params = null )
	{
		$this->columns = $columns;
		$this->params = $params;
		$this->table = $table;
		$this->builder = DB::table($table);
		$this->buildColumnsArray($columns);
		$this->completeQuery($params);

	}

	protected function buildColumnsArray($columns)
	{
		
		if (is_array($columns))
		{
			foreach ($columns as $name => $params) {
				if ($params['type']==NORMAL_TYPE)
				{
					$this->builder = $this->builder->addSelect($params['table'].'.'.$name);
				}
				if ($params['type']==COUNT_TYPE)
				{
					$this->builder = $this->builder->addSelect(DB::raw('COUNT('. $params['table'].'.'.$name .')'));
				}
			}
		}

		$this->builder = $this->builder->groupBy('products.id');
		
	}

	protected function completeQuery($params)
	{
		if (is_array($params))
		{
			foreach ($params as $param) {
				if ($param == 'join'){
					$this->builder->join($param['table'], $param['first'], $param['op'], $param['second']);
				}
			}
		}
	}

	public function get()
	{
		return $this->builder->get();
	}

	public function getSQL()
	{
		return $this->builder->toSql();
	}
}