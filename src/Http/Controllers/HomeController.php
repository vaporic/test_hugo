<?php
namespace TestHugo\Http\Controllers;

use Illuminate\Http\Request;
use TestHugo\Http\Views\View;

class HomeController
{
    /**
     * [index]
     * @param  Request $request
     */
    public function index(Request $request)
    {
        $view = new View('home',[
            'message' => 'Hello From a view!'
        ]);

        $response = $view->render();
        $response->send();
    }
}