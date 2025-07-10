<?php 
namespace App\Controllers;

use App\Models\WargaModel;

// Tambahan import AlertModel
use App\Models\AlertModel;

class Warga extends BaseController
{
    public function index()
    {
        $data['warga'] = (new WargaModel())->findAll();
        return view('warga/index', $data);
    }

    public function create()
    {
        // Menambahkan judul untuk halaman tambah warga
        $data['title'] = 'Tambah Warga';
        return view('warga/form', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $wargaModel = new WargaModel();
        $alertModel = new AlertModel(); // Inisialisasi AlertModel

        $postData = $this->request->getPost();

        // Insert data warga
        $wargaModel->insert($postData);

        // Tambahkan alert notifikasi ke database
        $alertModel->insert([
            'message' => 'Warga baru "' . $postData['nama'] . '" telah ditambahkan',
            'status' => 'unread'
        ]);

        // Set flashdata notifikasi sukses
        session()->setFlashdata('toast_message', 'Data warga berhasil ditambahkan!');
        session()->setFlashdata('toast_type', 'success');

        return redirect()->to('/warga');
    }

    public function edit($id)
    {
        // Menambahkan judul untuk halaman edit warga
        $data['title'] = 'Edit Warga';
        $data['warga'] = (new WargaModel())->find($id);
        return view('warga/form', $data);
    }

    public function update($id)
    {
        (new WargaModel())->update($id, $this->request->getPost());

        // Set flashdata notifikasi sukses
        session()->setFlashdata('toast_message', 'Data warga berhasil diperbarui!');
        session()->setFlashdata('toast_type', 'success');

        return redirect()->to('/warga');
    }

    public function delete($id)
    {
        (new WargaModel())->delete($id);

        // Set flashdata notifikasi sukses
        session()->setFlashdata('toast_message', 'Data warga berhasil dihapus!');
        session()->setFlashdata('toast_type', 'success');

        return redirect()->to('/warga');
    }
}
