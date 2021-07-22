<?php

namespace App\Controllers;
use App\Models\Datadonatur_model;

class Donatur extends BaseController
{
    protected $datadonatur;

    public function __construct()
    {
        $this->datadonatur = new Datadonatur_model();
    }

    public function index()
    {
        // $buku=$this->databuku->findAll();
        $data=[
            'title' => 'Daftar Donatur',
            'donatur'  => $this->datadonatur->paginate(2, 'datadonatur'),
            'pager' => $this->datadonatur->pager
        ];
    
        return view('donatur/index', $data);
    }

    public function detail($id){
        $data=[
            'title' => 'Detail Buku',
            'donatur'  => $this->datadonatur->getDonatur($id)
        ];
        return view ('donatur/detail', $data);
    }

    public function tambah(){
        $data=[
            'title'         => 'form tambah data',
            'validation'    => \Config\Services::validation()
        ];
        return view('donatur/tambahdata', $data);
    }

    public function simpan(){

        // validasi
        if(!$this->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'telpon' => 'required',
            'foto' => [
                'rules' =>'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            ],
        ])) {
            $validation=\Config\Services::validation();
            return redirect()->to('/Donatur/tambah')->withInput()->with('validation', $validation);
        }

        // ambil gambar
        $filefoto=$this->request->getFile('foto');
        // apakah tidak ada gambar yang di uplaod
        if($filefoto->getError()==4){
            $namaFoto='default.png';
        }else{
            // generate nama file random
            $namaFoto=$filefoto->getRandomName();
            // memindahkan image
            $filefoto->move('img', $namaFoto);
        }

        // ambil nama file
        // $namaCover=$filecover->getName();

        // $slug=url_title($this->request->getVar('judul'), '-', true);
        $data=[
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'telpon' => $this->request->getVar('telpon'),
            'foto' => $namaFoto,
        ];
        $this->datadonatur->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/donatur');
    }

    public function hapus($id){

        // cari gambar berdasarkan id
        $donatur=$this->datadonatur->find($id);

        // cek jika gambarnya default
        if($donatur['foto'] != 'default.png'){
            // hapus gambar
            unlink('img/'.$donatur['foto']);
        }
        
        $this->datadonatur->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil Dihapus');
        return redirect()->to('/donatur');
    }

    public function edit($id){
        // var_dump($this->request->getVar('coverLama'));
        $data=[
            'title'         => 'form ubah data',
            'validation'    => \Config\Services::validation(),
            'donatur'          => $this->datadonatur->getDonatur($id)
        ];
        return view('donatur/ubah', $data);
    }

    public function update($id){
        // mengecek apakah judul diganti
        // $penulislama=$this->databuku->getPenulis($this->request->getVar('lama'));

        // if($penulislama['judul'] == $this->request->getVar('judul')){
        //     $rule_judul='required';
        // }else{
        //     $rule_judul='required|is_unique[databuku.judul]';
        // };

        // validasi
        if(!$this->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'telpon' => 'required',
            'foto' => [
                'rules' =>'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            ],
        ])){
            return redirect()->to('/Donatur/edit/'.$this->request->getVar('slug'))->withInput();
        }
        
        $filefoto=$this->request->getFile('foto');
        // cek apakah gambar diubah
        if($filefoto->getError() == 4){
            $namaFoto=$this->request->getVar('lama');
        }else{
            // generate random name
            $namaFoto=$filefoto->getRandomName();
            // ambil nama file
            $filefoto->move('img', $namaFoto);
            // hapusfile lama
            // unlink('img/' . $this->request->getVar('coverLama'));
            // $namaCover=$filefoto->getName();
            // memindahkan file
        }

        // $slug=url_title($this->request->getVar('judul'), '-', true);
        $data=[
            'id'    => $id,
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'pekerjaan' => $this->request->getVar('pekerjaan'),
            'telpon' => $this->request->getVar('telpon'),
            'foto' => $namaFoto,
        ];

        $this->datadonatur->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/donatur');
    }

    public function cetak(){
        $data=[
            'title' => 'Daftar Donatur',
            'donatur'  => $this->datadonatur->getDonatur()
        ];
    
        return view('donatur/cetak', $data);
    }
}