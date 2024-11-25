<?php

namespace App\Controllers;

use App\Models\GalatModel;

class Galat extends BaseController
{
    protected $GalatModel;

    public function __construct()
    {
        $this->GalatModel = new GalatModel();
    }

    private function isLoggedIn()
    {
        if (!session()->get('isLoggedIn')) {
            // Mengatur pesan flashdata
            session()->setFlashdata('error', 'Kamu harus login terlebih dahulu untuk akses halaman ini.');
            return redirect()->to('/users');
        }
        return null;
    }

    private function isAdmin()
    {
        $userRole = session()->get('userRole');
        if ($userRole != 'Admin') {
            // Mengatur pesan flashdata
            session()->setFlashdata('error', 'Hanya admin yang dapat mengakses halaman ini.');
            return redirect()->to('/galat');
        }
        return null;
    }

    public function index()
    {
        if ($response = $this->isLoggedIn()) return $response;

        $sortOrder = $this->request->getGet('sort') ?? 'asc'; // Default ke 'asc' jika tidak ada parameter
        $search = $this->request->getGet('search');

        if ($search) {
            // Pencarian di semua kolom yang relevan
            $this->GalatModel
                ->groupStart()
                ->like('pelanggan', $search)
                ->orLike('no_so', $search)
                ->orLike('penjualan', $search)
                ->orLike('deskripsi', $search)
                ->groupEnd();
        }

        $data['galat'] = $this->GalatModel->orderBy('no_so', $sortOrder)->findAll();
        $data['userId'] = session()->get('userId');
        $data['userRole'] = session()->get('userRole');

        return view('galat/index', $data);
    }

    public function create()
    {
        $redirectResponse = $this->isLoggedIn(); // Cek login dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $redirectResponse = $this->isAdmin(); // Cek admin dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        return view('galat/create');
    }

    public function simpan()
    {
        $redirectResponse = $this->isLoggedIn(); // Cek login dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $redirectResponse = $this->isAdmin(); // Cek admin dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $data = [
            'tgl_order' => $this->request->getVar('tgl_order'),
            'no_so' => $this->request->getVar('no_so'),
            'penjualan' => $this->request->getVar('penjualan'),
            'pelanggan' => $this->request->getVar('pelanggan'),
            'qty' => $this->request->getVar('qty'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'harga' => $this->request->getVar('harga'),
            'status' => $this->request->getVar('status'),
            'deadline' => $this->request->getVar('deadline'),
        ];

        $this->GalatModel->save($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->to('/galat');
    }

    public function edit($id)
    {
        $redirectResponse = $this->isLoggedIn(); // Cek login dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $redirectResponse = $this->isAdmin(); // Cek admin dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $data['galat'] = $this->GalatModel->find($id);
        return view('galat/edit', $data);
    }

    public function update($id)
    {
        $redirectResponse = $this->isLoggedIn(); // Cek login dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $redirectResponse = $this->isAdmin(); // Cek admin dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $data = [
            'tgl_order' => $this->request->getPost('tgl_order'),
            'no_so' => $this->request->getPost('no_so'),
            'penjualan' => $this->request->getPost('penjualan'),
            'pelanggan' => $this->request->getPost('pelanggan'),
            'qty' => $this->request->getPost('qty'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'),
            'status' => $this->request->getPost('status'),
            'deadline' => $this->request->getPost('deadline')
        ];

        $this->GalatModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        return redirect()->to('/galat');
    }

    public function update_status($id)
    {
        $redirectResponse = $this->isLoggedIn(); // Cek login dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $status = $this->request->getPost('status');

        $data = [
            'status' => $status,
        ];

        if ($status == 'Selesai') {
            session()->setFlashdata('success', 'Status berhasil diupdate.');
        }

        $this->GalatModel->update($id, $data);
        return redirect()->to(base_url('/galat'));
    }

    public function delete($id)
    {
        $redirectResponse = $this->isLoggedIn(); // Cek login dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $redirectResponse = $this->isAdmin(); // Cek admin dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }

        $this->GalatModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/galat');
    }
}
