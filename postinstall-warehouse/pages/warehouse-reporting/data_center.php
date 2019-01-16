<?php
require_once('vendor/autoload.php');
require_once "reports/product/ProductQuantity.php";
require_once "reports/document/Document.php";

function toMiladi($value)
{
	if (is_string($value))
    {
        if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}\z/", $value )) {		

            $t=preg_split("/-/",$value);		

            $y = $t[0];		
            $m = $t[1];		
            $d = $t[2];		


            $new_date = mds_to_gregorian($y , $m , $d);		
            $new_date[1]=str_pad($new_date[1], 2, '0', STR_PAD_LEFT);		
            $new_date[2]=str_pad($new_date[2], 2, '0', STR_PAD_LEFT);		

            return join("-" , $new_date);		

        }else{

            return $value;

        }
    }
    else
    {
    	return $value;
    }
}





$type = $request->request->get('type');
	if ($type =='first')
	{
		$params = array(
		'ids' => $request->request->get('ids'),
		'from' => $request->request->get('from'),
		'to'=> $request->request->get('to'),
		'category_ids' => $request->request->get('category_ids'),
		'inventory_ids' => $request->request->get('inventory_ids'),
		'show_criticals' => $request->request->get('show_criticals'),
	);
		$params['settings'] = $MySettings;
		$ProductQuantity = new ProductQuantity($params);
		$ProductQuantity->run()->render();

			}
	elseif ($type == 'second') {

		// converting the dates from shamsi to miladi
		$to = toMiladi($request->request->get('to'));
		$from = toMiladi($request->request->get('from'));


		$params = array(
			'id' => $request->request->get('id'),
			'to' => $to,//$request->request->get('to'),
			'from' => $from, //$request->request->get('from'),
		);
		$params['settings'] = $MySettings;
		$Document = new Document($params);
		$Document->run()->render();

		
	}