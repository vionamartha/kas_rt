<?php    
namespace App\Controllers;

use App\Models\IuranModel;
use App\Models\WargaModel;
use App\Models\PermohonanModel; 

class Home extends BaseController
{
    public function dashboard()
    {
        $iuranModel = new IuranModel();
        $wargaModel = new WargaModel();
        $permohonanModel = new PermohonanModel(); 

        // 1. Total kas tahunan (tahun berjalan)
        $kasTahunan = $iuranModel
            ->select('SUM(jumlah) as total')
            ->where('tahun', date('Y'))
            ->first();

        // 2. Kas bulanan (per bulan)
        $kasBulanan = $iuranModel
            ->select('bulan, SUM(jumlah) as total')
            ->groupBy('bulan')
            ->findAll();

        // 3. Warga tertunggak bulan ini (belum bayar)
        $bulanIni = date('F'); // Contoh: "May"
        $totalWarga = $wargaModel->countAll();
        $sudahBayar = $iuranModel->where('bulan', $bulanIni)->distinct()->countAllResults('warga_id');
        $tertunggak = $totalWarga - $sudahBayar;

        // 4. Permohonan Kas
        $permohonanKas = $permohonanModel->countAllResults(); 

        $data = [
            'title'             => 'Dashboard Kas RT',
            'kasTahunan'        => $kasTahunan['total'] ?? 0,
            'kasBulanan'        => $kasBulanan,
            'tertunggak'        => $tertunggak,
            'permohonanKas'     => $permohonanKas 
        ];

        return view('dashboard', $data);
    }
}
