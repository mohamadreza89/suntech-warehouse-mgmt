<?php

// ProductQuantity.php - Report setup file
require_once "vendor/autoload.php";
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;
use Illuminate\Database\Capsule\Manager as Capsule;

class Document extends \koolreport\KoolReport
{


    public function settings()
    {
        $MySettings = $this->params['settings'];
        
        return array(
            "dataSources"=>array(
                "itop4"=>array(
                    "connectionString"=>"mysql:host=".$MySettings['db_host'].";dbname=".$MySettings['db_name'],
                    "username"=>$MySettings['db_user'],
                    "password"=>$MySettings['db_pwd'],
                    "charset"=>"utf8"
                )
            )
        );
    }

    public function setup()
    {

        $sql = $this->buildQuery();

        //echo $sql;
       
        $this->src('itop4')
        ->query($sql )
        /*
        ->pipe(new Group(array(
            "by"=>"CatTitle",
            "sum"=>"quantity"
        )))
        */
        /*
        ->pipe(new Sort(array(
            "dollar_sales"=>"desc"
        )))
        ->pipe(new Limit(array(10)))
        */
        ->pipe($this->dataStore('test'));
        
    }
    protected function buildQuery()
    {
        $records = DB::table('functional_documents as t')
            ->select('t.ref as ref',
                't.product_category_id',
                'pc.title as category',
                't.product_id',
                't.created_at',
                't.balance as balance',
                'p.title as title',
                'c.name as contact',
                DB::raw('(SELECT SUM(x.balance) FROM functional_documents as x WHERE x.product_id = t.product_id AND x.id <= t.id) as cSum') 
            )
            ->leftJoin('ci-assignment as ca', 'ca.id', 't.id')
            ->leftJoin('ticket', 'ticket.id', 'ca.ticket_id')
            ->leftJoin('contact as c', 'c.id', 'ticket.caller_id')
            ->leftJoin('products AS p', 'p.id', '=','t.product_id')
            ->leftJoin('product_categories as pc', 'pc.id', '=','t.product_category_id')
            ->where('t.product_id',$this->params['id']);
        

        $from = $this->params['from'];
        if ($from != '')
        {
            $records = $records->where('t.created_at' , '>=' , $from);
        }
        $to = $this->params['to'];
        if ($to != '')
        {
            $records = $records->where('t.created_at' , '<=' , $to);
        }

        $query = str_replace(array('?'), array('\'%s\''), $records->toSql());
        $query = vsprintf($query, $records->getBindings());



        //$query = 'SELECT t.`ref` as ref, t.`product_category_id`, pc.`title` as category , t.`product_id` , t.`created_at` , t.`balance` as balance, p.`title` as title , (SELECT SUM(x.`balance`) FROM `functional_documents` as x WHERE x.`product_id` = t.`product_id` AND x.`id` <= t.`id`) as cSum FROM `functional_documents` as t LEFT JOIN products AS p ON  p.`id` = t.`product_id` LEFT JOIN product_categories as pc ON pc.`id` = t.`product_category_id` WHERE t.`product_id` = '. $this->params['id'].' AND t.`created_at` >= "'. $this->params['from'] .'" AND  t.`created_at` <="'. $this->params['to'] .'" ORDER BY t.`id` ASC';

        //echo $query;
        
        return $query;
    }
}