<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * If users have a RESOURCE permission in any menu descendants or the menu itself, then they will have access to that menu
     * If a menu has a resource, on the frontend, that means that that menu has a page
     *
     */
    public function index()
    {
        //
    }
}
