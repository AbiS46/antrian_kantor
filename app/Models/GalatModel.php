<?php
// app/Models/GalatModel.php
namespace App\Models;

use CodeIgniter\Model;

class GalatModel extends Model
{
    protected $table = 'galat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tgl_order', 'no_so', 'penjualan', 'pelanggan', 'qty', 'deskripsi', 'harga', 'deadline', 'status'];

    public function getGalat()
    {
        return $this->findAll();
    }

    public function countByStatus($status)
    {
        if (is_array($status)) {
            $this->whereIn('status', $status);
        } else {
            $this->where('status', $status);
        }
        return $this->countAllResults();
    }
}
