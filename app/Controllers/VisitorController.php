<?php

namespace App\Controllers;
use App\Models\UserModel;

class VisitorController extends BaseController
{
    public function DashboardPage()
    {
        session()->setFlashdata('success', 'Welcome Visitor');
        return view('/UserTypePage/Pages/user-type');
    }

}
