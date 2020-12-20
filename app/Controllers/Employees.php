<?php

namespace App\Controllers;

use App\Models\M_WS;

class Employees extends BaseController
{
    protected $m_ws;
    public function __construct()
    {
        $this->m_ws = new M_WS();
    }

    public function index()
    {
        $employeesData = $this->m_ws->getEmployees();

        $data['employeesData'] = json_decode($employeesData);

        return view('home', $data);
    }

    //////////////////////////////// CREATE ////////////////////////////////
    public function new()
    {
        return view('new');
    }

    public function create()
    {
        $data = $this->request->getPost();

        $result = $this->m_ws->createEmployee($data);

        if ($result) {
            session()->setFlashdata('employee', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan!</div>');
            return redirect()->to('/Employees');
        } else {
            session()->setFlashdata('employee', '<div class="alert alert-danger" role="alert">Data Gagal Disimpan!</div>');
            return redirect()->to('/Employees/new');
        }
    }
    //////////////////////////////// END CREATE ////////////////////////////////

    //////////////////////////////// UPDATE ////////////////////////////////
    public function edit($emp_no)
    {
        $employeeData = $this->m_ws->getEmployee($emp_no);
        $data['employeeData'] = json_decode($employeeData);

        return view('edit', $data);
    }

    public function update($emp_no)
    {
        $data = $this->request->getPost();

        $result = $this->m_ws->updateEmployee($emp_no, $data);

        if ($result) {
            session()->setFlashdata('employee', '<div class="alert alert-success" role="alert">Data Berhasil Diubah!</div>');
            return redirect()->to('/Employees');
        } else {
            session()->setFlashdata('employee', '<div class="alert alert-danger" role="alert">Data Gagal Diubah!</div>');
            return redirect()->to('/Employees/edit/' . $emp_no);
        }
    }
    //////////////////////////////// END UPDATE ////////////////////////////////

    ////////////////////////////////  DELETE ////////////////////////////////
    public function delete($emp_no)
    {
        $result = $this->m_ws->deleteEmployee($emp_no);

        if ($result) {
            session()->setFlashdata('employee', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');
            return redirect()->to('/Employees');
        } else {
            session()->setFlashdata('employee', '<div class="alert alert-danger" role="alert">Data Gagal Dihapus!</div>');
            return redirect()->to('/Employees/new');
        }
    }
    //////////////////////////////// END DELETE ////////////////////////////////



    //--------------------------------------------------------------------

}
