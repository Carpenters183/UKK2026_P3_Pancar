@extends('layouts.admin')

@section('title', 'Dashboard Guru')

@section('styles')
<style>
    .stat-card-guru {
        border: none; border-radius: 16px; overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stat-card-guru:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.18); }
    .stat-card-guru .card-body { padding: 1.3rem 1.5rem; }
    .stat-card-guru .g-icon {
        width: 50px; height: 50px; border-radius: 13px;
        background: rgba(255,255,255,0.22);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; flex-shrink: 0;
    }
    .stat-card-guru .g-label {
        font-size: 0.72rem; font-weight: 600;
        letter-spacing: 0.5px; text-transform: uppercase;
        opacity: 0.85; margin-bottom: 3px;
    }
    .stat-card-guru .g-value { font-size: 1.9rem; font-weight: 800; line-height: 1; margin: 0; }

    .grad-slate   { background: linear-gradient(135deg, #334155 0%, #64748b 100%); color:#fff; }
    .grad-orange  { background: linear-gradient(135deg, #c2410c 0%, #fb923c 100%); color:#fff; }
    .grad-cyan    { background: linear-gradient(135deg, #155e75 0%, #22d3ee 100%); color:#fff; }
    .grad-emerald { background: linear-gradient(135deg, #064e3b 0%, #34d399 100%); color:#fff; }

    .card-guru {
        border: none; border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.07);
    }
    .card-guru .card-header {
        border-radius: 16px 16px 0 0; border: none;
        background: #fff; padding: 1.1rem 1.4rem 0.6rem;
    }
    .hdr-icon {
        width: 30px; height: 30px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.95rem; color: #fff;
    }

    /* Table override */
    .tbl-guru { font-size: 0.83rem; }
    .tbl-guru thead th {
        background: #f8fafc; font-size: 0.75rem;
        font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.4px; color: #64748b;
        border-bottom: 2px solid #e2e8f0; padding: 10px 12px;
    }
    .tbl-guru tbody td { padding: 10px 12px; vertical-align: middle; border-color: #f1f5f9; }
    .tbl-guru tbody tr:hover { background: #f8fafc; }

    /* Status bar */
    .pct-row { margin-bottom: 14px; }
    .pct-row .pct-top { display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 5px; }
    .pct-row .pct-label { font-weight: 600; color: #374151; }
    .pct-row .pct-val { font-weight: 700; }
    .pct-track { height: 8px; border-radius: 20px; background: #f0f0f0; overflow: hidden; }
    .pct-fill { height: 100%; border-radius: 20px; }

    /* Info table */
    .info-tbl td, .info-tbl th { font-size: 0.82rem; padding: 7px 10px; border-color: #f1f5f9; }
    .info-tbl th { color: #6b7280; font-weight: 600; width: 45%; }
</style>
@endsection

@section('content')

{{-- ══ STAT CARDS ══ --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card stat-card-guru grad-slate">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="g-label">Total Aspirasi</div>
                        <h3 class="g-value">{{ $statistik['total'] }}</h3>
                    </div>
                    <div class="g-icon"><i class="ph ph-stack"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card-guru grad-orange">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="g-label">Menunggu</div>
                        <h3 class="g-value">{{ $statistik['menunggu'] }}</h3>
                    </div>
                    <div class="g-icon"><i class="ph ph-hourglass-medium"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card-guru grad-cyan">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="g-label">Diproses</div>
                        <h3 class="g-value">{{ $statistik['proses'] }}</h3>
                    </div>
                    <div class="g-icon"><i class="ph ph-arrows-clockwise"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card-guru grad-emerald">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="g-label">Selesai</div>
                        <h3 class="g-value">{{ $statistik['selesai'] }}</h3>
                    </div>
                    <div class="g-icon"><i class="ph ph-check-fat"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══ TABLE + SIDEBAR ══ --}}
<div class="row g-3">
    <div class="col-md-8">
        <div class="card card-guru">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="hdr-icon" style="background:linear-gradient(135deg,#334155,#64748b);">
                        <i class="ph ph-list-bullets"></i>
                    </div>
                    <h6 class="mb-0 fw-bold" style="font-size:0.9rem;">Aspirasi Terbaru</h6>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table tbl-guru mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                @if(!$guru->canCreateAspirasi())
                                <th>Pengirim</th>
                                @endif
                                <th>Kategori</th>
                                <th>Ruangan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasiTerbaru as $a)
                            <tr>
                                <td><span style="font-size:0.75rem;color:#9ca3af;">#{{ $a->id_aspirasi }}</span></td>
                                @if(!$guru->canCreateAspirasi())
                                <td>
                                    @php $pengirim = $a->user->siswa ?? $a->user->guru; @endphp
                                    <span class="fw-600">{{ $pengirim->nama ?? $a->user->email }}</span>
                                    <br><small class="text-muted">{{ $pengirim->kelas ?? $pengirim->jabatan ?? '-' }}</small>
                                </td>
                                @endif
                                <td>{{ $a->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $a->ruangan->nama_ruangan ?? $a->lokasi }}</td>
                                <td>
                                    @php
                                        $sc = $a->status == 'Selesai' ? ['bg'=>'#d1fae5','col'=>'#065f46'] :
                                             ($a->status == 'Proses'  ? ['bg'=>'#e0f2fe','col'=>'#0c4a6e'] :
                                                                         ['bg'=>'#fef3c7','col'=>'#92400e']);
                                    @endphp
                                    <span class="badge" style="background:{{ $sc['bg'] }};color:{{ $sc['col'] }};border-radius:20px;font-size:0.72rem;padding:4px 10px;">
                                        {{ $a->status }}
                                    </span>
                                </td>
                                <td style="color:#6b7280;font-size:0.78rem;">{{ $a->created_at ? $a->created_at->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <a href="{{ route('guru.aspirasi.detail', $a->id_aspirasi) }}" class="btn btn-sm" style="background:linear-gradient(135deg,#155e75,#22d3ee);color:#fff;border-radius:8px;padding:4px 10px;font-size:0.75rem;">
                                        <i class="ph ph-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ $guru->canCreateAspirasi() ? '6' : '7' }}" class="text-center py-4 text-muted">
                                    <i class="ph ph-inbox" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                                    Belum ada aspirasi
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3 text-center border-top" style="border-color:#f1f5f9!important;">
                    <a href="{{ route('guru.aspirasi.index') }}" class="btn btn-sm" style="background:linear-gradient(135deg,#334155,#64748b);color:#fff;border-radius:20px;padding:6px 20px;font-size:0.8rem;">
                        <i class="ph ph-list"></i> Lihat Semua Aspirasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        {{-- Persentase Status --}}
        @if($guru->canViewStatistik() || in_array($guru->jabatan, ['Kepala Sekolah','Wakil Kepala Sekolah','Kepala Jurusan']))
        <div class="card card-guru mb-3">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="hdr-icon" style="background:linear-gradient(135deg,#c2410c,#fb923c);">
                        <i class="ph ph-chart-pie"></i>
                    </div>
                    <h6 class="mb-0 fw-bold" style="font-size:0.9rem;">Persentase Status</h6>
                </div>
            </div>
            <div class="card-body" style="padding:1rem 1.4rem;">
                @php
                    $total = $statistik['total'] > 0 ? $statistik['total'] : 1;
                    $persenMenunggu = round(($statistik['menunggu'] / $total) * 100);
                    $persenProses   = round(($statistik['proses'] / $total) * 100);
                    $persenSelesai  = round(($statistik['selesai'] / $total) * 100);
                @endphp
                <div class="pct-row">
                    <div class="pct-top">
                        <span class="pct-label"><i class="ph ph-hourglass" style="color:#f59e0b;"></i> Menunggu</span>
                        <span class="pct-val" style="color:#f59e0b;">{{ $persenMenunggu }}%</span>
                    </div>
                    <div class="pct-track"><div class="pct-fill" style="width:{{ $persenMenunggu }}%;background:linear-gradient(90deg,#b45309,#f59e0b);"></div></div>
                </div>
                <div class="pct-row">
                    <div class="pct-top">
                        <span class="pct-label"><i class="ph ph-arrows-clockwise" style="color:#22d3ee;"></i> Diproses</span>
                        <span class="pct-val" style="color:#0891b2;">{{ $persenProses }}%</span>
                    </div>
                    <div class="pct-track"><div class="pct-fill" style="width:{{ $persenProses }}%;background:linear-gradient(90deg,#155e75,#22d3ee);"></div></div>
                </div>
                <div class="pct-row" style="margin-bottom:0;">
                    <div class="pct-top">
                        <span class="pct-label"><i class="ph ph-check-circle" style="color:#34d399;"></i> Selesai</span>
                        <span class="pct-val" style="color:#059669;">{{ $persenSelesai }}%</span>
                    </div>
                    <div class="pct-track"><div class="pct-fill" style="width:{{ $persenSelesai }}%;background:linear-gradient(90deg,#064e3b,#34d399);"></div></div>
                </div>
            </div>
        </div>
        @endif

        {{-- Informasi Akun --}}
        <div class="card card-guru">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="hdr-icon" style="background:linear-gradient(135deg,#1e3a5f,#2d6a9f);">
                        <i class="ph ph-user-circle"></i>
                    </div>
                    <h6 class="mb-0 fw-bold" style="font-size:0.9rem;">Informasi Akun</h6>
                </div>
            </div>
            <div class="card-body" style="padding:0.8rem 1.4rem;">
                <table class="table info-tbl mb-0">
                    <tr><th>Nama</th><td>{{ $guru->nama }}</td></tr>
                    <tr><th>Jabatan</th>
                        <td>
                            <span class="badge bg-{{ $guru->jabatan_badge }}" style="font-size:0.73rem;">{{ $guru->jabatan }}</span>
                        </td>
                    </tr>
                    <tr><th>NIP</th><td>{{ $guru->nip ?? '-' }}</td></tr>
                    <tr><th>Mata Pelajaran</th><td>{{ $guru->mata_pelajaran ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('chartAspirasi');
        if (canvas) {
            const labels = {!! json_encode($bulanLabels ?? []) !!};
            const data = {!! json_encode($bulanData ?? []) !!};
            if (labels.length > 0 && data.length > 0) {
                new Chart(canvas, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Aspirasi',
                            data: data,
                            backgroundColor: 'rgba(79, 70, 229, 0.7)',
                            borderColor: '#4f46e5',
                            borderWidth: 1,
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: { legend: { position: 'top' } },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 } },
                            x: { title: { display: true, text: 'Bulan' } }
                        }
                    }
                });
            }
        }
    });
</script>
@endpush