<?php

namespace App\Controllers;

class Pages extends BaseController
{
	public function index()
	{
        $data =[
            'title'=>'Home'
        ];
		echo view('Pages/home', $data);
	}
    public function penulis()
	{
        $data =[
            'title'=>'penulis'
        ];
        echo view('Pages/penulis', $data);
	}
    public function contact()
	{
        $data =[
            'title'=>'Contact'
        ];
        echo view('Pages/contact', $data);
	}
}