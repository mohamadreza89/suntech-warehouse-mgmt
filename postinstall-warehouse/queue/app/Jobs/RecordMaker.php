<?php

namespace App\Jobs;

use Complex\Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class RecordMaker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    public $timeout = 10000;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Execute the job.
     *
     * @param Request $request
     * @return void
     */
    public function handle()
    {
        $jRequest = Storage::get('request.json');
        $request = json_decode($jRequest , true);


        // Getting the Warehouse Document
        $id = $request['id'];
        $oObj = $this->getWarehouseDocument($id);

 
        // Getting the parameters to fill the new CIs that are going to be created
        $params = $this->getParams($request, $oObj);

        // preparing additional parameters
        $ci_type = $oObj->Get('physical_device_type');
        $count = $oObj->Get('count');
        $name = $params['name'];


        // Creating the CIs
        for($i=1; $i <= $count ; $i++)
        {
            $params['name'] = $name . str_pad($i , 4, 0 , STR_PAD_LEFT);

            $oCI = $this->createCI($ci_type, $params);
            Storage::put('ci-id', $oCI->Get('id'));
            $this->createLink($oObj, $oCI);
        }
    }

    /**
     * Insert the values of mandatory CI attributes in the params array
     *
     * @param $params
     * @param $oObj
     * @return mixed
     */
    protected function prepareParams($params, $oObj)
    {
        foreach ($params as $key => $value) {
            switch ($key) {
                case 'org_id':
                    $params[$key] = $oObj->Get('org_id');
                    break;

                case 'warehouse_document_id':
                    $params[$key] = (int)$oObj->Get('id');
                    break;

                case 'product_id':
                    $params[$key] = $oObj->Get('product_id');
                    break;

            }
        }
        return $params;
    }

    /**
     * Get the related warehouse document obj based on the given id
     *
     * @param $id
     * @return \DBObject|null
     */
    protected function getWarehouseDocument($id)
    {
        try {
            $oObj = \MetaModel::GetObject(\WarehouseDocument::class, $id, true);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return $oObj;
    }

    /**
     * Insert the values of arbitrary CI attributes in the params array
     *
     * @param $oObj
     * @param $params
     * @return mixed
     */
    protected function finalizeParams($oObj, $params)
    {
        $params['purchase_date'] = $oObj->Get('invoice_date');
        $params['end_of_warranty'] = $oObj->Get('end_of_warranty');
        $params['status'] = 'stock';

        return $params;
    }

    /**
     * Creates a proper functional CI
     *
     * @param $ci_type
     * @param $params
     * @return $oCI
     */
    protected function createCI($ci_type, $params)
    {
        $oCI = \MetaModel::NewObject($ci_type, $params);
        // $oCI->Set('purchase_date', null /**$params['purchase_date']*/);
        // $oCI->Set('end_of_warranty', null /**$params['end_of_warranty']*/);
        $oCI->DBInsertNoReload();
        return $oCI;
    }

    /**
     * Create a link between the given warehouse document and the given functional CI
     *
     * @param $oObj
     * @param $oCI
     * @return $CiRel
     */
    protected function createLink($oObj, $oCI)
    {
        $oCiRel = \MetaModel::NewObject("lnkWarehouseDocToPhysicalDevice", [
            'warehouse_document_id' => $oObj->Get('id'),
            'physical_device_id' => $oCI->Get('id'),
        ]);
        $oCiRel->DBInsertNoReload();

        return $oCiRel;
    }

    /**
     * Gets the params for CI filling
     *
     * @param Request $request
     * @param $oObj
     * @return array|mixed
     */
    protected function getParams($request, $oObj)
    {
        $params = json_decode($request['params'], true);
        $params = $this->prepareParams($params, $oObj);
        $params = $this->finalizeParams($oObj, $params);
        return $params;
    }
}
