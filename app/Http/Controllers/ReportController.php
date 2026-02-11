<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Siswa;
use App\Models\Dokumen;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Show report page
     */
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalPendaftaran = Pendaftaran::count();
        $totalDokumen = Dokumen::count();

        return view('admin.reports.index', compact('totalSiswa', 'totalPendaftaran', 'totalDokumen'));
    }

    /**
     * Export pendaftaran data to CSV
     */
    public function exportPendaftaran()
    {
        $pendaftarans = Pendaftaran::with('siswa', 'statusPendaftaran', 'jurusanPilihan1', 'jurusanPilihan2')
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="Pendaftaran_' . now()->format('d-m-Y') . '.csv"',
        ];

        $callback = function() use ($pendaftarans) {
            $file = fopen('php://output', 'w');
            
            // BOM untuk UTF-8 Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header tabel
            fputcsv($file, [
                'No',
                'No. Pendaftaran',
                'Nama Siswa',
                'Email',
                'No. Handphone',
                'Asal Sekolah',
                'Jurusan Pilihan 1',
                'Jurusan Pilihan 2',
                'Status',
                'Tanggal Pendaftaran',
                'Harga Gelombang',
                'Gelombang'
            ], ';', '"');

            // Data
            foreach ($pendaftarans as $key => $p) {
                fputcsv($file, [
                    $key + 1,
                    $this->cleanData($p->nomor_pendaftaran),
                    $this->cleanData($p->siswa?->nama_lengkap),
                    $this->cleanData($p->siswa?->email),
                    $this->cleanData($p->siswa?->no_hp),
                    $this->cleanData($p->siswa?->asal_sekolah),
                    $this->cleanData($p->jurusanPilihan1?->nama_jurusan),
                    $this->cleanData($p->jurusanPilihan2?->nama_jurusan),
                    $this->cleanData($p->statusPendaftaran?->label ?? 'Menunggu'),
                    $p->created_at?->format('d/m/Y H:i') ?? '-',
                    number_format($p->harga_gelombang ?? 0, 0, ',', '.'),
                    $this->cleanData($p->gelombang),
                ], ';', '"');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export dokumen data to CSV
     */
    public function exportDokumen()
    {
        $dokumens = Dokumen::with('siswa', 'jenisDokumen', 'statusVerifikasi')
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="Dokumen_' . now()->format('d-m-Y') . '.csv"',
        ];

        $callback = function() use ($dokumens) {
            $file = fopen('php://output', 'w');
            
            // BOM untuk UTF-8 Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header tabel
            fputcsv($file, [
                'No',
                'Nama Siswa',
                'Jenis Dokumen',
                'Status Verifikasi',
                'Komentar Verifikasi',
                'Tanggal Upload',
                'Tanggal Update'
            ], ';', '"');

            // Data
            foreach ($dokumens as $key => $d) {
                fputcsv($file, [
                    $key + 1,
                    $this->cleanData($d->siswa?->nama_lengkap),
                    $this->cleanData($d->jenisDokumen?->nama),
                    $this->cleanData($d->statusVerifikasi?->label ?? 'Menunggu'),
                    $this->cleanData($d->komentar_verifikasi),
                    $d->created_at?->format('d/m/Y H:i') ?? '-',
                    $d->updated_at?->format('d/m/Y H:i') ?? '-',
                ], ';', '"');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export activity log to CSV
     */
    public function exportActivityLog()
    {
        $activities = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="Activity_Log_' . now()->format('d-m-Y') . '.csv"',
        ];

        $callback = function() use ($activities) {
            $file = fopen('php://output', 'w');
            
            // BOM untuk UTF-8 Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header tabel
            fputcsv($file, [
                'No',
                'Nama User',
                'Email User',
                'Aksi',
                'Deskripsi',
                'IP Address',
                'Waktu'
            ], ';', '"');

            // Data
            foreach ($activities as $key => $a) {
                fputcsv($file, [
                    $key + 1,
                    $this->cleanData($a->user?->name),
                    $this->cleanData($a->user?->email),
                    $this->cleanData($a->action),
                    $this->cleanData($a->description),
                    $this->cleanData($a->ip_address),
                    $a->created_at?->format('d/m/Y H:i:s') ?? '-',
                ], ';', '"');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Helper function to clean data for CSV export
     */
    private function cleanData($value)
    {
        if (is_null($value)) {
            return '-';
        }
        // Remove line breaks
        $value = str_replace(["\r\n", "\r", "\n", "\t"], ' ', $value);
        // Remove multiple spaces
        $value = preg_replace('/\s+/', ' ', $value);
        return trim($value);
    }

    /**
     * Show statistics summary
     */
    public function statistics()
    {
        $pendaftaranPerStatus = DB::table('pendaftarans')
            ->leftJoin('status_pendaftarans', 'pendaftarans.status_id', '=', 'status_pendaftarans.id')
            ->select('status_pendaftarans.label', DB::raw('count(*) as total'))
            ->groupBy('status_pendaftarans.label')
            ->get();

        $dokumenPerStatus = DB::table('dokumens')
            ->join('status_verifikasis', 'dokumens.status_verifikasi_id', '=', 'status_verifikasis.id')
            ->select('status_verifikasis.label', DB::raw('count(*) as total'))
            ->groupBy('status_verifikasis.label')
            ->get();

        $siswaPerJurusan = DB::table('pendaftarans')
            ->leftJoin('jurusans', 'pendaftarans.jurusan_pilihan_1', '=', 'jurusans.id')
            ->select('jurusans.nama', DB::raw('count(*) as total'))
            ->whereNotNull('jurusans.id')
            ->groupBy('jurusans.nama')
            ->get();

        return view('admin.reports.statistics', compact('pendaftaranPerStatus', 'dokumenPerStatus', 'siswaPerJurusan'));
    }
}
