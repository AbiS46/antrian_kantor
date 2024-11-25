<?php

namespace App\Controllers;

use App\Models\PoModel;

class Po extends BaseController
{
    protected $PoModel;

    public function __construct()
    {
        $this->PoModel = new PoModel();
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
            return redirect()->to('/po');
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
            $this->PoModel
                ->groupStart()
                ->like('pelanggan', $search)
                ->orLike('no_so', $search)
                ->orLike('penjualan', $search)
                ->orLike('deskripsi', $search)
                ->groupEnd();
        }

        $data['po'] = $this->PoModel->orderBy('no_so', $sortOrder)->findAll();
        $data['userId'] = session()->get('userId');
        $data['userRole'] = session()->get('userRole');

        return view('po/index', $data);
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

        return view('po/create');
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

        $this->PoModel->save($data);
        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->to('/po');
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

        $data['po'] = $this->PoModel->find($id);
        return view('po/edit', $data);
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

        $this->PoModel->update($id, $data);
        session()->setFlashdata('success', 'Data berhasil diupdate.');
        return redirect()->to('/po');
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

        if ($status == 'Selesai'){
            session()->setFlashdata('success', 'Status berhasil diupdate.');
        }

        $this->PoModel->update($id, $data);
        return redirect()->to(base_url('/po'));
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

        $this->PoModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        return redirect()->to('/po');
    }
}
