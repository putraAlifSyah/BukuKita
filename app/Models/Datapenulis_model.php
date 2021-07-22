<?php

namespace App\Models;

use CodeIgniter\Model;

class Datapenulis_model extends Model
{
    protected $table='datapenulis';
    protected $useTimestamps=true;
    protected $allowedFields=['nama', 'tanggal_lahir', 'deskripsi', 'alamat', 'foto', 'motto'];

    public function getPenulis($id = false)
    {
        if($id==false)
        {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
