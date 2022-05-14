<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
    protected $oeangmodel; 
    public function __construct()
    {
        $this->orangmodel = new OrangModel();
    }
    public function index(){
        // $orang = $this->orangmodel->findall();
        $currentpage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1 ;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $orang = $this->orangmodel->search($keyword);
        } else{
            $orang = $this->orangmodel;
        }
        $data = [
            'title' => 'orang',
            'orang' => $orang->paginate(10, 'orang'),
            'pager' => $this->orangmodel->pager,
            'currentpage'=> $currentpage
        ];
            
    return view('orang/index', $data);

    }

    
}