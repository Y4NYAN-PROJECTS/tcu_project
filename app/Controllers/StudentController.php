<?php

namespace App\Controllers;
use App\Models\UserModel;

class StudentController extends BaseController
{
    public function DashboardPage()
    {
        session()->setFlashdata('success', 'Welcome Back!');
        return view('/StudentPages/Pages/dashboard');
    }

    public function EntranceFormPage()
    {
        session()->setFlashdata('success', 'Welcome Back!');
        return view('/StudentPages/Pages/entrance-form');
    }

    public function EquipmentsPage()
    {
        session()->setFlashdata('success', 'Welcome Back!');
        return view('/StudentPages/Pages/equipments');
    }

    public function HistoryPage()
    {
        session()->setFlashdata('success', 'Welcome Back!');
        return view('/StudentPages/Pages/history');
    }

}
