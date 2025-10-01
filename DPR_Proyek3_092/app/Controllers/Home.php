<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Check if user is logged in
        if (session()->get('is_logged_in')) {
            return redirect()->to('/dashboard');
        }
        
        return view('welcome_message');
    }
}
