<?php

namespace App\Http\Controllers;

use App\Jobs\RecordMaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecordController extends Controller
{
    public function handle(Request $request)
    {
        Storage::put('request.json' , json_encode($request->all())); 
        RecordMaker::dispatch();
    }
}
