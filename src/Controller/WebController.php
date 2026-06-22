<?php

namespace App\Controller;

use Database\Client\SecondaryDB;
use Core\Request;
use Exception;

class WebController
{
    public function home(Request $request)
    {
        $dbstatus_message = '<span>Database successfully connected</span>';

        try {
            SecondaryDB::conn();
        } catch (Exception $e) {
            $dbstatus_message = "<b style=\"color:red\">Database connection error:</b> " . $e->getMessage();
        }

        return view('home', [
            'php_version' => phpversion(),
            'dbstatus_message' => $dbstatus_message,
        ]);
    }
}

