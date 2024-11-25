<?php
// app/Models/AntrianModel.php
namespace App\Models;

use CodeIgniter\Model;

class SablonModel extends Model
{
    protected $table = 'sablon';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tgl_order', 'no_so', 'penjualan', 'pelanggan', 'qty', 'deskripsi', 'harga', 'deadline', 'status'];

    public function getSablon()
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
