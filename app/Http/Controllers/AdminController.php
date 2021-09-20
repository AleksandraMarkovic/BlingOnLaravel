<?php

namespace App\Http\Controllers;

use App\Models\Admin;

class AdminController extends OsnovniController
{

    private $adminModel;

    public function index(){
        $this->adminModel = new Admin();
        $this->data['admins'] = $this->adminModel->getForAdmin();
        return view('admin.admin', $this->data);
    }

    public function admin(){
        $this->adminModel = new Admin();
        $adminData = $this->adminModel->getForAdmin();
        return $adminData;
    }
}
