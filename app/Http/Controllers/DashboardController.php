<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{

    public function index(){
        Redis::set('key', 'hello from the redis');
        $data = Cache::store('redis')->get('key');
        return response(['msg' => $data]);
    }
}
