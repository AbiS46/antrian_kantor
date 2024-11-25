<?php
// app/Models/SelesaiModel.php
namespace App\Models;

use CodeIgniter\Model;

class SelesaiModel extends Model
{
    protected $table = 'selesai';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tgl_order', 'no_so', 'penjualan', 'pelanggan', 'qty', 'deskripsi', 'harga', 'deadline', 'status'];

    public function getSelesai()
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
