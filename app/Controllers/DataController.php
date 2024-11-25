<?php
namespace App\Controllers;

use App\Models\GeneralModel;

class DataController extends BaseController
{
    protected $generalModel;

    public function __construct()
    {
        $this->generalModel = new GeneralModel();
    }

    public function move($fromTable, $toTable, $id)
    {
        // Pastikan tabel yang dituju valid
        $validTables = ['po', 'penjahit', 'bordir', 'sablon', 'packing', 'kirim', 'galat', 'selesai'];
        if (!in_array($fromTable, $validTables) || !in_array($toTable, $validTables)) {
            session()->setFlashdata('error', 'Tabel tidak valid.');
            return redirect()->back();
        }

        // Pindahkan data
        if ($this->generalModel->moveData($fromTable, $toTable, $id)) {
            session()->setFlashdata('success', 'Data berhasil dipindahkan.');
        } else {
            session()->setFlashdata('error', 'Gagal memindahkan data.');
        }

        return redirect()->to('/' . $fromTable); // Redirect ke halaman tabel asal
    }
}
