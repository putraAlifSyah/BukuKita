<?php

namespace App\Controllers;
use App\Models\Databuku_model;

class Buku extends BaseController
{
    protected $databuku;

    public function __construct()
    {
        $this->databuku = new Databuku_model();
    }

    public function index()
    {
        // $buku=$this->databuku->findAll();
        $data=[
            'title' => 'Daftar Buku',
            'buku'  => $this->databuku->paginate(2, 'databuku'),
            'pager' => $this->databuku->pager
        ];
    
        return view('buku/index', $data);
    }

    public function detail($slug){
        $data=[
            'title' => 'Detail Buku',
            'buku'  => $this->databuku->getBuku($slug)
        ];
        return view ('buku/detail', $data);
    }

    public function tambah(){
        $data=[
            'title'         => 'form tambah data',
            'validation'    => \Config\Services::validation()
        ];
        return view('buku/tambahdata', $data);
    }

    public function simpan(){

        // validasi
        if(!$this->validate([
            'judul' => 'required|is_unique[databuku.judul]',
            'penulis' => 'required',
            'penerbit' => 'required',
            'sinopsis' => 'required',
            'cover' => [
                'rules' =>'max_size[cover,2048]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
            ],
        ])) {
            $validation=\Config\Services::validation();
            return redirect()->to('/Buku/tambah')->withInput()->with('validation', $validation);
        }

        // ambil gambar
        $filecover=$this->request->getFile('cover');
        // apakah tidak ada gambar yang di uplaod
        if($filecover->getError()==4){
            $namaCover='default.png';
        }else{
            // generate nama file random
            $namaCover=$filecover->getRandomName();
            // memindahkan image
            $filecover->move('img', $namaCover);
        }


        // ambil nama file
        // $namaCover=$filecover->getName();


        $slug=url_title($this->request->getVar('judul'), '-', true);
        $data=[
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'cover' => $namaCover,
            'sinopsis' => $this->request->getVar('sinopsis'),
        ];
        $this->databuku->save($data);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/buku');
    }

    public function hapus($id){

        // cari gambar berdasarkan id
        $buku=$this->databuku->find($id);

        // cek jika gambarnya default
        if($buku['cover'] != 'default.png'){
            // hapus gambar
            unlink('img/'.$buku['cover']);
        }
        
        $this->databuku->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil Dihapus');
        return redirect()->to('/buku');
    }

    public function edit($slug){
        // var_dump($this->request->getVar('coverLama'));
        $data=[
            'title'         => 'form ubah data',
            'validation'    => \Config\Services::validation(),
            'buku'          => $this->databuku->getBuku($slug)
        ];
        return view('buku/ubah', $data);
    }

    public function update($id){
        // mengecek apakah judul diganti
        $bukulama=$this->databuku->getBuku($this->request->getVar('slug'));

        if($bukulama['judul'] == $this->request->getVar('judul')){
            $rule_judul='required';
        }else{
            $rule_judul='required|is_unique[databuku.judul]';
        };

        // validasi
        if(!$this->validate([
            'judul' => $rule_judul,
            'penulis' => 'required',
            'penerbit' => 'required',
            'sinopsis' => 'required',
            'cover' => 'max_size[cover,2048]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
        ])){
            return redirect()->to('/Buku/edit/'.$this->request->getVar('slug'))->withInput();
        }
        
        $fileCover=$this->request->getFile('cover');
        // cek apakah gambar diubah
        if($fileCover->getError() == 4){
            $namaCover=$this->request->getVar('coverLama');
        }else{

            // generate random name
            $namaCover=$fileCover->getRandomName();
            // ambil nama file
            $fileCover->move('img', $namaCover);
            // hapusfile lama
            // unlink('img/' . $this->request->getVar('coverLama'));
            // $namaCover=$fileCover->getName();
            // memindahkan file
        }

        $slug=url_title($this->request->getVar('judul'), '-', true);
        $data=[
            'id'    => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'cover' => $namaCover,
            'sinopsis' => $this->request->getVar('sinopsis'),
        ];

        $this->databuku->save($data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/buku');
    }
    
    public function cetak(){
        $data=[
            'title' => 'Daftar Buku',
            'buku'  => $this->databuku->getBuku()
        ];
    
        return view('buku/cetak', $data);
    }
}