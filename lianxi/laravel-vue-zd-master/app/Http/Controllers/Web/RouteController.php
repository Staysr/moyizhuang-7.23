<?php

namespace App\Http\Controllers\Web;


class RouteController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function operate(){
        return view('operate');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mobile(){
        return view('mobile');
    }
}
