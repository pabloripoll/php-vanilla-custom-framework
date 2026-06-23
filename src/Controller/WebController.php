<?php

namespace App\Controller;

use Config\Request;

class WebController
{
    public function home(Request $request)
    {
        return view('home', [
            'php_version' => phpversion(),
        ]);
    }
}

