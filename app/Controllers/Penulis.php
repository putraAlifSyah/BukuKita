<?php

namespace App\Controllers;
use App\Models\Datapenulis_model;

class Penulis extends BaseController
{
    protected $datapenulis;

    public function __construct()
    {
        $this->datapenulis = new Datapenulis_model();
    }

    public function index()
    {
        // $buku=$this->databuku->findAll();
        $data=[
            'title' => 'Daftar Penulis',
            'penulis'  => $this->datapenulis->paginate(2, 'datapenulis'),
            'pager' => $this->datapenulis->pager
        ];
    
        return view('penulis/index', $data);
    }

    public function detail($id){
        $data=[
            'title' => 'Detail Buku',
            'penulis'  => $this->datapenulis->getPenulis($id)
        ];
        return view ('penulis/detail', $data);
    }

    public function tambah(){
        $data=[
            'title'         => 'form tambah data',
            'validation'    => \Config\Services::validation()
        ];
        return view('penulis/tambahdata', $data);
    }

    public function simpan(){

        // validasi
        if(!$this->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'foto' => [
                'rules' =>'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            ],
            'motto' => 'required',
        ])) {
            $validation=\Config\Services::validation();
            return redirect()->to('/Penulis/tambah')->withInput()->with('validation', $validation);
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
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'alamat' => $this->request->getVar('alamat'),
            'foto' => $namaFoto,
            'sinopsis' => $this->request->getVar('sinopsis'),
            'motto' => $this->request->getVar('motto'),
        ];
        $this->datapenulis->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/penulis');
    }

    public function hapus($id){

        // cari gambar berdasarkan id
        $penulis=$this->datapenulis->find($id);

        // cek jika gambarnya default
        if($penulis['foto'] != 'default.png'){
            // hapus gambar
            unlink('img/'.$penulis['foto']);
        }
        
        $this->datapenulis->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil Dihapus');
        return redirect()->to('/penulis');
    }

    public function edit($id){
        // var_dump($this->request->getVar('coverLama'));
        $data=[
            'title'         => 'form ubah data',
            'validation'    => \Config\Services::validation(),
            'penulis'          => $this->datapenulis->getPenulis($id)
        ];
        return view('penulis/ubah', $data);
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
            'tanggal_lahir' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'foto' => [
                'rules' =>'max_size[foto,2048]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
            ],
            'motto' => 'required',
        ])){
            return redirect()->to('/Penulis/edit/'.$this->request->getVar('slug'))->withInput();
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
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'alamat' => $this->request->getVar('alamat'),
            'foto' => $namaFoto,
            'sinopsis' => $this->request->getVar('sinopsis'),
            'motto' => $this->request->getVar('motto'),
        ];

        $this->datapenulis->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/penulis');
    }

    public function cetak(){
        $data=[
            'title' => 'Daftar penulis',
            'penulis'  => $this->datapenulis->getPenulis()
        ];
    
        return view('penulis/cetak', $data);
    }
}