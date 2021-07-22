<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Frontend extends Controller
{
	public function index()
	{
		
		return view('login/login');
	}

	
	public function register()
	{
		session();
		$data = [
			'validate' => \Config\Services::validation(),
		];
		return view('login/register',$data);
	}

	//--------------------------------------------------------------------

}
