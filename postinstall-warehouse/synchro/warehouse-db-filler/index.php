<?php
/**
 * Created by PhpStorm.
 * User: m.pishdad
 * Date: 10/21/2018
 * Time: 1:03 PM
 */

use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpSpreadsheet\Reader\Xls;


require __DIR__.'/vendor/autoload.php';
require __DIR__.'/Record.php';

require_once('../../approot.inc.php');
require_once('../../application/application.inc.php');
require_once('../../application/itopwebpage.class.inc.php');
require_once('../../application/wizardhelper.class.inc.php');

require_once('../../application/startup.inc.php');


/**
echo "<pre>";
var_dump($spreadsheet->getActiveSheet()->getCell('G5')->getValue());
echo "</pre>";

echo "<pre>";
var_dump($spreadsheet->getActiveSheet()->getColumnDimensions());
echo "</pre>";

echo "<pre>";
$rows = $spreadsheet->getActiveSheet()->getRowDimensions();
var_dump($rows[500]);
echo "</pre>";
 * */


try{
    $reader = new Xls();
    $reader->setLoadSheetsOnly('PC');
    $spreadsheet = $reader->load('test.xls');
    $sheet = $spreadsheet->getActiveSheet();
}catch(Exception $e){
    echo "first part <br/>";
    echo $e->getMessage();
}

$data = new Collection();


$columns=$sheet->getColumnDimensions();
$rows=$sheet->getRowDimensions();
unset($rows[1]);

try{
    foreach ($rows as $r => $rv)
    {
        $model[$r] = new Record();
        foreach ($columns as $c => $cv)
        {
            $att = $sheet->getCell($c.'1')->getValue();
            $model[$r]->$att = $sheet->getCell($c.$r)->getValue();
        }
        $data->add($model[$r]);
    }
}catch(Exception $e)
{
    echo $e->getMessage();
}


/**
echo "<pre>";
var_dump($aData = $data->toArray());
echo "</pre>";

echo "<table class='table'>";
foreach ($aData as $key=>$aRec)
{
    echo "<tr>";
    foreach ($aRec as $key => $value){
        echo "<td>".$value."</td>";
    }

    echo "</tr>";
}
echo "</table>";

*/
$warehouse_org='3';
$warehouse_caller = '14';

/**
 * ------------------
 *  PRODUCT CATEGORY
 * ------------------
 */
$data->each(function($model){
    $product_category_title = $model->product_category;
    $product_category = MetaModel::GetObjectByColumn(ProductCategory::class,'title', $product_category_title ,false);
    if (!$product_category)
    {
        $product_category=MetaModel::NewObject(ProductCategory::class,[
            'title'=>$product_category_title,
            'is_active'=>1,
        ]);
        $product_category->DBInsertNoReload();
        $model->product_category_obj = $product_category;
        $model->product_category_id = $product_category->Get('id');
        echo "product ".$product_category_title." got created <br/>";
    }else{
        $model->product_category_obj = $product_category;
        $model->product_category_id = $product_category->Get('id');
        echo "product ".$product_category_title." has been already created <br/>";
    }

    $product_categories[]=$product_category_title;
});


/**
 * --------
 * PRODUCT
 * --------
 */
$products = [];
$data->each(function($model , $key) use(&$products){
    $product_title = $model->product;
    $product = MetaModel::GetObjectByColumn(Product::class,'title', $product_title ,false);
    if (!$product)
    {
        $product=MetaModel::NewObject(Product::class,[
            'product_category_id'=>$model->product_category_id,
            'title'=>$product_title,
            'technical_title'=>$product_title,
            'is_active'=>1,
            'physical_device_type'=>$model->type,
        ]);
        $product->DBInsertNoReload();
        $model->product_obj =  $product;
        $model->product_id = $product->Get('id');
        echo "product ".$product_title." got created <br/>";
    }else{
        $model->product_obj =  $product;
        $model->product_id = $product->Get('id');
        echo "product ".$product_title." has been already created <br/>";
    }

    $products[$product_title]=array(
        'product'=>array(
            'title'=>$product->Get('title'),
            'id'=>$product->Get('id'),
            'product_category_id'=>$product->Get('product_category_id'),
            'physical_device_type'=>$product->Get('physical_device_type'),
        )
    );
});

foreach ($products as &$product)
{
    $product['models']=$data->where('product', $product['product']['title'])->all();
    $i=0;
    $models = $product['models'];
    unset($product['models']);
    foreach ($models as $model)
    {
        $product['models'][$i++]=$model;
    }
}


/**
 * -------------------
 * WAREHOUSE DOCUMENT
 * -------------------
 */

foreach ($products as &$product) {
    $count = count($product['models']);
    $wd = MetaModel::NewObject(WarehouseDocument::class,[
        'invoice_serial'=>'000',
        'org_id'=>$warehouse_org,
        'caller_id'=>$warehouse_caller,
        'product_category_id'=>$product['product']['product_category_id'],
        'product_id'=>$product['product']['id'],
        'count'=>$count,
        'inventory_id'=>1,
    ]);

    $wd->DBInsertNoReload();
    $product['wd']=MetaModel::GetObject(WarehouseDocument::class,$wd->Get('id'));

    echo 'warehouse document '. $wd->Get('id').' got created <br/>';

}

/**
 * -------------------
 *  PHYSICAL DEVICES
 * -------------------
 */

$CIs = [];
$j = 0;

foreach ($products as &$product)
{
    $aLinks = $product['wd']->Get('physical_device_list')->ToArray();
echo "<hr/>";
echo $product['product']['title'];
dump($aLinks);
    $i=0;

    foreach ($aLinks as $oLink)
    {
        $pid = $oLink->Get('physical_device_id');
        $pd = MetaModel::GetObject(PhysicalDevice::class,$pid);
        $pd->Set('name',$product['models'][$i]->name);
        $pd->DBUpdate();

        $product['models'][$i]->ci = ['id'=>$pid];
        $CIs[$j++] = $product['models'][$i++];

        echo "<pre>";
        var_dump($pd->Get('name'));
        echo "</pre>";
    }
}
echo "<hr/>";
echo $j;
echo "<hr/>";


/**
 * ------------------
 *   FAKE TICKETS
 * ------------------
 */

foreach ($CIs as &$ci)
{
    if ($ci->assigned_to != '')
    {
        $user = MetaModel::GetObjectByColumn(User::class,'login',$ci->assigned_to);
        $person = MetaModel::GetObjectByColumn(Person::class,'id',$user->Get('id'));

        $ticket = MetaModel::NewObject(FakeTicket::class,[
            'org_id'=>$person->Get('org_id'),
            'caller_id'=> $user->Get('contactid'),
            'title'=>'fake ticket for initial CI assignment',
            'description'=>'automatically generated',
        ]);
        $ticket->DBInsertNoReload();

        $ci->ticket = $ticket;
        echo "<pre>";
        //var_dump($ci->ticket);
        echo "</pre>";
    }

}


/**
 * ------------------
 *   CI ASSIGNMENTS
 * ------------------
 */
echo "<hr/><pre>";
dump($CIs);
echo "</pre><hr/>";

foreach ($CIs as $ci)
{
    if ($ci->assigned_to != '')
    {
        $ca = MetaModel::NewObject(CiAssignment::class,[
            'ticket_id'=>$ci->ticket->Get('id'),
            'ci_id'=> $ci->ci['id'],
            'product_category_id'=>$ci->product_category_id,
            'product_id'=>$ci->product_id,
            'date'=> date('Y-m-d'),
        ]);

        $ca->DBInsertNoReload();
        echo 'CI Assignment document '. $ca->Get('id').' got created <br/>';
    }
}