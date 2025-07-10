<?php 
namespace App\Controllers;

use App\Models\IuranModel;
use App\Models\WargaModel;

class Iuran extends BaseController
{
    public function index()
    {
        $iuranModel = new IuranModel();
        $data['iuran'] = $iuranModel
            ->select('iuran.*, warga.nama')
            ->join('warga', 'warga.id = iuran.warga_id')
            ->findAll();

        return view('iuran/index', $data);
    }

    public function create()
    {
        // Menambahkan title untuk halaman tambah iuran
        $data['title'] = 'Tambah Iuran';
        $wargaModel = new WargaModel();
        $data['warga'] = $wargaModel->findAll();
        return view('iuran/form', $data);
    }

    public function store()
    {
        $rules = [
            'warga_id'      => 'required|is_natural_no_zero',
            'bulan'         => 'required',
            'tahun'         => 'required|numeric',
            'jumlah'        => 'required|numeric',
            'tanggal_bayar' => 'required|valid_date',
            'keterangan'    => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'warga_id'      => $this->request->getPost('warga_id'),
            'bulan'         => $this->request->getPost('bulan'),
            'tahun'         => $this->request->getPost('tahun'),
            'jumlah'        => $this->request->getPost('jumlah'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $iuranModel = new IuranModel();
        $iuranModel->insert($data);

        // Set flashdata untuk toast notification sukses
        session()->setFlashdata('toast_message', 'Data iuran berhasil ditambahkan.');
        session()->setFlashdata('toast_type', 'success');

        return redirect()->to('/iuran');
    }

    // Fungsi edit, menampilkan form dengan data iuran yang ingin diedit
    public function edit($id)
    {
        // Menambahkan title untuk halaman edit iuran
        $data['title'] = 'Edit Iuran';
        $iuranModel = new IuranModel();
        $wargaModel = new WargaModel();

        $data['iuran'] = $iuranModel->find($id);
        $data['warga'] = $wargaModel->findAll();

        if (!$data['iuran']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data iuran dengan ID $id tidak ditemukan.");
        }

        return view('iuran/form', $data);
    }

    // Fungsi update, proses update data iuran berdasarkan form edit
    public function update($id)
    {
        $rules = [
            'warga_id'      => 'required|is_natural_no_zero',
            'bulan'         => 'required',
            'tahun'         => 'required|numeric',
            'jumlah'        => 'required|numeric',
            'tanggal_bayar' => 'required|valid_date',
            'keterangan'    => 'permit_empty'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'warga_id'      => $this->request->getPost('warga_id'),
            'bulan'         => $this->request->getPost('bulan'),
            'tahun'         => $this->request->getPost('tahun'),
            'jumlah'        => $this->request->getPost('jumlah'),
            'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $iuranModel = new IuranModel();
        $iuranModel->update($id, $data);

        // Set flashdata untuk toast notification sukses
        session()->setFlashdata('toast_message', 'Data iuran berhasil diperbarui.');
        session()->setFlashdata('toast_type', 'success');

        return redirect()->to('/iuran');
    }

    public function delete($id)
    {
        $iuranModel = new IuranModel();
        $iuranModel->delete($id);

        // Set flashdata untuk toast notification sukses
        session()->setFlashdata('toast_message', 'Data iuran berhasil dihapus.');
        session()->setFlashdata('toast_type', 'success');

        return redirect()->to('/iuran');
    }
}
