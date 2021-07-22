<?php

namespace App\Models;

use CodeIgniter\Model;

class Datadonatur_model extends Model
{
    protected $table='datadonatur';
    protected $useTimestamps=true;
    protected $allowedFields=['nama', 'alamat', 'pekerjaan', 'telpon', 'foto'];

    public function getDonatur($id = false)
    {
        if($id==false)
        {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
