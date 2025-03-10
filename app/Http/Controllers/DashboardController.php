<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{

    public function index(){

        // Redis::set('secondkey', 'hello redis from second key');
        // $data = Cache::store('redis')->get('secondkey');
        $data = 'Hello world';
        return response(['msg' => $data]);
    }
}
