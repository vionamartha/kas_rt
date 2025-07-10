<?php  
namespace App\Controllers;

use App\Models\PermohonanModel;
use App\Models\AlertModel;
use App\Models\WargaModel;  // Model untuk mengambil data warga

class PermohonanKas extends BaseController
{
    public function index()
    {
        $data['permohonanKas'] = (new PermohonanModel())->findAll();
        return view('permohonan_kas/index', $data);
    }

    public function create()
    {
        // Menambahkan judul untuk halaman tambah permohonan kas
        $data['title'] = 'Tambah Permohonan Kas';
        
        // Menambahkan data warga untuk dropdown
        $wargaModel = new WargaModel();
        $data['warga'] = $wargaModel->findAll();  // Mendapatkan semua data warga
        
        return view('permohonan_kas/form', $data);
    }

    public function store()
    {
        $rules = [
            'nama_permohonan' => 'required',
            'jumlah_kas' => 'required|numeric',
            'status' => 'required',
            'tanggal_permohonan' => 'required|valid_date',
            'keterangan' => 'permit_empty',
            'warga_id' => 'required|numeric' // Menambahkan validasi untuk warga_id
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $permohonanModel = new PermohonanModel();
        $alertModel = new AlertModel(); 

        $postData = $this->request->getPost();

        // Insert data permohonan kas termasuk warga_id
        $permohonanModel->insert($postData);

        // Menyimpan notifikasi alert
        $alertModel->insert([
            'message' => 'Permohonan kas "' . $postData['nama_permohonan'] . '" telah ditambahkan',
            'status' => 'unread'
        ]);

        // Set flashdata notifikasi sukses
        session()->setFlashdata('toast_message', 'Data permohonan kas berhasil ditambahkan!');
        session()->setFlashdata('toast_type', 'success');

        return redirect()->to('/permohonan_kas');
    }

    public function edit($id)
    {
        // Menambahkan judul untuk halaman edit permohonan kas
        $data['title'] = 'Edit Permohonan Kas';
        $data['permohonanKas'] = (new PermohonanModel())->find($id);
        
        // Menambahkan data warga untuk dropdown pada halaman edit
        $wargaModel = new WargaModel();
        $data['warga'] = $wargaModel->findAll();  // Mendapatkan semua data warga
        
        return view('permohonan_kas/form', $data);
    }

    public function update($id)
    {
        $permohonanModel = new PermohonanModel();

        $rules = [
            'nama_permohonan' => 'required',
            'jumlah_kas' => 'required|numeric',
            'status' => 'required',
            'tanggal_permohonan' => 'required|valid_date',
            'keterangan' => 'permit_empty',
            'warga_id' => 'required|numeric' // Menambahkan validasi untuk warga_id
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data permohonan kas
        $permohonanModel->update($id, $this->request->getPost());

        // Set flashdata notifikasi sukses
        session()->setFlashdata('toast_message', 'Data permohonan kas berhasil diperbarui!');
        session()->setFlashdata('toast_type', 'success');

        return redirect()->to('/permohonan_kas');
    }

    public function delete($id)
    {
        $permohonanModel = new PermohonanModel();

        // Hapus data permohonan kas
        $permohonanModel->delete($id);

        // Set flashdata notifikasi sukses
        session()->setFlashdata('toast_message', 'Data permohonan kas berhasil dihapus!');
        session()->setFlashdata('toast_type', 'success');

        return redirect()->to('/permohonan_kas');
    }
}
