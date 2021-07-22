<?php

namespace App\Models;

use CodeIgniter\Model;

class Databuku_model extends Model
{
    protected $table='databuku';
    protected $useTimestamps=true;
    protected $allowedFields=['judul', 'slug', 'penulis', 'penerbit', 'cover', 'sinopsis'];

    public function getBuku($slug = false)
    {
        if($slug==false)
        {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
}
