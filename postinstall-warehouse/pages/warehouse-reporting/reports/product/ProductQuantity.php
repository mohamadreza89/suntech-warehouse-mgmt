<?php

// ProductQuantity.php - Report setup file
require_once "vendor/autoload.php";
use \koolreport\processes\Group;
use \koolreport\processes\Sort;
use \koolreport\processes\Limit;
use Illuminate\Database\Capsule\Manager as Capsule;

class ProductQuantity extends \koolreport\KoolReport
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
        $records = DB::table('physicaldevice as pd')->select('pc.title as CatTitle','p.title', 'p.technical_title as techTitle', 'p.order_point', 'i.title as invTitle' , DB::raw('COUNT(pd.id) as quantity'))->join('products as p', 'product_id', '=','p.id')->join('product_categories as pc','p.product_category_id', '=','pc.id')->join('warehouse_document as wd','pd.warehouse_document_id', '=','wd.id')->join('inventory as i','wd.inventory_id', '=','i.id')->groupBy('pd.product_id')->where('pd.status', 'stock');

        $from = $this->params['from'];
        if ($from != '')
        {
            $records = $records->having('quantity' , '>=' , $from);
        }
        $to = $this->params['to'];
        if ($to != '')
        {
            $records = $records->having('quantity' , '<=' , $to);
        }
        $ids = $this->params['ids'];
        if (($ids !=null)AND(is_array($ids)))
        {
            $records = $records->whereIn('pd.product_id', $ids);
        }

        $category_ids = $this->params['category_ids'];
        if (($category_ids !=null)AND(is_array($category_ids)))
        {
            $records = $records->whereIn('p.product_category_id', $category_ids);
        }

        $inventory_ids = $this->params['inventory_ids'];
        if (($inventory_ids !=null)AND(is_array($inventory_ids)))
        {
            $records = $records->whereIn('wd.inventory_id', $inventory_ids);
        }

        $show_criticals = $this->params['show_criticals'];
        if ($show_criticals == 'on')
        {
            $records = $records->having('quantity', '<', DB::raw('order_point'));
        }

        $query = str_replace(array('?'), array('\'%s\''), $records->toSql());
        $query = vsprintf($query, $records->getBindings());

        return $query;
    }
}