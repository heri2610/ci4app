<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikmodel; 
    public function __construct()
    {
        $this->komikmodel = new KomikModel();
    }
    public function index(){
        $komik = $this->komikmodel->getkomik();
        $data = [
            'title' => 'komik',
            'komik' => $komik
        ];
            
    return view('komik/index', $data);

    }

    public function detail($slug){
        $komik = $this->komikmodel->getkomik($slug);
        $data = [
            'title' => 'detail',
            'komik' => $komik
        ];

        if(empty($data['komik'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik ' . $slug . ' tidak ditemukan');
        }
        return view('komik/detail', $data);
    }

    public function create(){
        $data= [
            'title'=> 'form tambah data',
            'validation' => \config\Services::validation()
        ];
        return view('komik/create', $data);
    }

    public function save(){

        if(!$this->validate([
            'judul' => 'required|is_unique[komik.judul]',
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors'=>[
                    'max_size'=> 'ukuran gamba terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])){
            // $validation = \config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/komik/create')->withInput();
        }
        // ambil gambar
        $filesampul = $this->request->getFile('sampul');
        // apakah tidak ada gambar yang d upload
        if($filesampul->getError() == 4){
            $namasampul = 'default.jpg';
        } else{

            // generate nama sampul randhom opsi2
            $namasampul = $filesampul->getRandomName();
            // pindahkan k folder img
            $filesampul->move('img', $namasampul);
            // ambil nama file sampul opsi 1
            // $namasampul = $filesampul->getName();
        }

        $slug = url_title($this->request->getVar('judul'),('-'), true);
        $this->komikmodel->save([
         'judul' => $this->request->getVar('judul'),
         'slug' => $slug,
         'penulis' => $this->request->getVar('penulis'),
         'penerbit' => $this->request->getVar('penerbit'),
         'sampul' => $namasampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/komik');
    }


    public function delete($id){
        // cari gambarberdasarkan id
        $komik = $this->komikmodel->find($id);
        // cek jika file gambarnya default
        if($komik['sampul']!= 'default.jpg'){
            // hapus gambar
            unlink('img/' . $komik['sampul']);
        }

        $this->komikmodel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/komik');
    }

    public function edit($slug){
        $data= [
            'title'=> 'form ubah data',
            'validation' => \config\Services::validation(),
            'komik' => $this->komikmodel->getkomik($slug)
        ];
        return view('komik/edit', $data);
    }

    public function update($id){
        $komiklama = $this->komikmodel->getkomik($this->request->getVar('slug'));
        if($komiklama['judul'] == $this->request->getVar('judul')){
            $rule_judul = 'required';
        }
        else{
            $rule_judul = 'required|is_unique[komik.judul]';

        }
        if(!$this->validate([
            'judul' => $rule_judul,
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors'=>[
                    'max_size'=> 'ukuran gamba terlalu besar',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'mime_in' => 'yang anda pilih bukan gambar'
                ]
            ]
        ])){
        
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $filesampul = $this->request->getFile('sampul');
        // cek gambar apakah tetap gambar lama
        if ($filesampul->getError()==4) {
            $namasampul = $this->request->getVar('sampullama');
        } else{
            $namasampul = $filesampul->getRandomName();
            $filesampul->move('img', $namasampul);
            unlink('img/' . $this->request->getVar('sampullama'));
        }

        $slug = url_title($this->request->getVar('judul'),('-'), true);
        $this->komikmodel->save([
        'id' => $id,
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $namasampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');

        return redirect()->to('/komik');
    }

}