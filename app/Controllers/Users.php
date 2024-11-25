<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Users extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UsersModel();
    }

    private function setSession($user)
    {
        session()->set([
            'isLoggedIn' => true,
            'userId' => $user['id'],
            'username' => $user['username'],
            'userRole' => $user['role'],
        ]);
    }

    private function isLoggedIn()
    {
        if (session()->get('isLoggedIn')) {
            // Mengatur pesan flashdata
            return redirect()->to('/beranda');
        }
        return null;
    }

    public function index()
    {
        $redirectResponse = $this->isLoggedIn(); // Cek login dan dapatkan response redirect jika perlu
        if ($redirectResponse) {
            return $redirectResponse; // Kembalikan response redirect
        }
        return view('users/index');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->model->getUser($username);

        if ($user && password_verify($password, $user['password'])) {
            $this->setSession($user);
            session()->setFlashdata('msg', 'Login sukses');
            return redirect()->to('/beranda');
        }

        session()->setFlashdata('msg', $user ? 'Password salah' : 'Username tidak ditemukan');
        return redirect()->back()->withInput();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/users');
    }

    public function create()
    {
        return view('users/create');
    }

    public function store()
    {
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'password' => 'required',
            'role' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('error', 'Username sudah ada.');
            return redirect()->to('/users/create')->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ];

        $this->model->save($data);
        session()->setFlashdata('success', 'Username berhasil dibuat!');
        return redirect()->to('/users/create');
    }

    public function edit()
    {
        return view('users/edit');
    }

    public function change_password()
    {
        $rules = [
            'username' => 'required',
            'new_password' => 'required',
        ];

        if (!$this->validate($rules)) {
            $data = [
                'validation' => $this->validator,
                'old' => $this->request->getPost()
            ];
            return view('path/to/form_view', $data);
        }

        $username = $this->request->getPost('username');
        $newPassword = $this->request->getPost('new_password');
        $user = $this->model->where('username', $username)->first();

        if (!$user) {
            session()->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->back()->withInput();
        }

        $data = [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ];

        $this->model->update($user['id'], $data);
        session()->setFlashdata('success', 'Password berhasil diubah.');
        return redirect()->to('/users/edit');
    }
}
