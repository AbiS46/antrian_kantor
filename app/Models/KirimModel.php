<?php
// app/Models/KirimModel.php
namespace App\Models;

use CodeIgniter\Model;

class KirimModel extends Model
{
    protected $table = 'kirim';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tgl_order', 'no_so', 'penjualan', 'pelanggan', 'qty', 'deskripsi', 'harga', 'deadline', 'status'];

    public function getKirim()
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
