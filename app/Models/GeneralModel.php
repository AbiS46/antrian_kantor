<?php
namespace App\Models;

use CodeIgniter\Model;

class GeneralModel extends Model
{
    public function moveData($fromTable, $toTable, $id)
    {
        // Ambil data dari tabel asal
        $data = $this->db->table($fromTable)->where('id', $id)->get()->getRowArray();

        if ($data) {
            // Hapus data dari tabel asal
            $this->db->table($fromTable)->delete(['id' => $id]);

            // Ubah status untuk tabel tujuan jika perlu
            $data['status'] = ucfirst($toTable); // Mengubah status sesuai tabel tujuan

            // Simpan data ke tabel tujuan
            $this->db->table($toTable)->insert($data);

            return true;
        }

        return false;
    }
}
