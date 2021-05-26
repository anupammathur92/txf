<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function front(){
        return redirect()->route('front');
    }
    public function clear_cache(){
        \Artisan::call("cache:clear");
        \Artisan::call("config:clear");
        \Artisan::call("view:clear");
        \Artisan::call("event:clear");
        \Artisan::call("optimize:clear");
        \Artisan::call("route:clear");
        echo "cache cleared"; die;
    }
    public function migrate_run(){
        \Artisan::call("migrate");
        \Artisan::call('db:seed');
        echo "migration run successful"; die;
    }
}
?>