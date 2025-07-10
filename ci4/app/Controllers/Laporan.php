<?php
namespace App\Controllers;

use App\Models\IuranModel;

class Laporan extends BaseController
{
    public function index()
    {
        $data['laporan'] = (new IuranModel())
            ->select('tahun, bulan, SUM(jumlah) as total')
            ->groupBy(['tahun', 'bulan'])
            ->orderBy('tahun DESC, bulan DESC')
            ->findAll();

        return view('laporan/index', $data);
    }

    public function pdf()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        if (empty($bulan) || empty($tahun)) {
            return redirect()->to('/error');
        }

        $validBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        if (!in_array($bulan, $validBulan) || !is_numeric($tahun)) {
            return redirect()->to('/error');
        }

        
        $query = (new IuranModel())
            ->select('tahun, bulan, SUM(jumlah) as total, COUNT(DISTINCT iuran.warga_id) as jumlah_warga')  
            ->join('warga', 'warga.id = iuran.warga_id', 'left') 
            ->groupBy(['tahun', 'bulan']);

        if ($bulan) {
            $query->where('bulan', $bulan);
        }

        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        $data['laporan'] = $query->findAll();

        $dompdf = new \Dompdf\Dompdf();
        $html = view('laporan/pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream("laporan_kas_{$bulan}_{$tahun}.pdf", ['Attachment' => true]);
    }
}
