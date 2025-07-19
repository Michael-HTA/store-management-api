<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{

    public function index()
    {
        // Redis::set('key', 'hello from the redis');
        // $data = Cache::store('redis')->get('key');

        // Redis::set('finalkey', 'hello redis from second key');
        // $data = Cache::get('secondkey');
        // $data = Redis::get('secondkey');
        // $data = 'Hello world';

        Cache::store('redis')->put('finalkey', 'final value', 600); // 10 minutes
        $data = Cache::store('redis')->get('finalkey');

        return response(['msg' => $data]);
    }
}
