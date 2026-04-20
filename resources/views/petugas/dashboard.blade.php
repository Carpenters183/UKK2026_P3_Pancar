@extends('layouts.admin')

@section('title', 'Dashboard Petugas')

@section('styles')
<style>
    .stat-card-pet {
        border: none; border-radius: 16px; overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stat-card-pet:hover { transform: translateY(-4px); box-shadow: 0 8px 25px rgba(0,0,0,0.18); }
    .stat-card-pet .card-body { padding: 1.3rem 1.5rem; }
    .stat-card-pet .p-icon {
        width: 50px; height: 50px; border-radius: 13px;
        background: rgba(255,255,255,0.22);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; flex-shrink: 0;
    }
    .stat-card-pet .p-label { font-size: 0.72rem; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; opacity: 0.85; margin-bottom: 3px; }
    .stat-card-pet .p-value { font-size: 1.9rem; font-weight: 800; line-height: 1; margin: 0; }

    .grad-violet  { background: linear-gradient(135deg, #4c1d95 0%, #8b5cf6 100%); color:#fff; }
    .grad-rose2   { background: linear-gradient(135deg, #881337 0%, #fb7185 100%); color:#fff; }
    .grad-teal2   { background: linear-gradient(135deg, #134e4a 0%, #2dd4bf 100%); color:#fff; }
    .grad-lime    { background: linear-gradient(135deg, #3f6212 0%, #a3e635 100%); color:#fff; }

    .card-pet { border: none; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.07); }
    .card-pet .card-header { border-radius: 16px 16px 0 0; border: none; background: #fff; padding: 1.1rem 1.4rem 0.6rem; }
    .p-hdr-icon { width: 30px; height: 30px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 0.95rem; color: #fff; }

    .tbl-pet { font-size: 0.83rem; }
    .tbl-pet thead th { background: #faf5ff; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px; color: #6d28d9; border-bottom: 2px solid #ede9fe; padding: 10px 12px; }
    .tbl-pet tbody td { padding: 10px 12px; vertical-align: middle; border-color: #f5f3ff; }
    .tbl-pet tbody tr:hover { background: #faf5ff; }

    .pct-row2 { margin-bottom: 14px; }
    .pct-row2 .pct-top2 { display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 5px; }
    .pct-row2 .pct-label2 { font-weight: 600; color: #374151; }
    .pct-row2 .pct-val2 { font-weight: 700; }
    .pct-track2 { height: 8px; border-radius: 20px; background: #f0f0f0; overflow: hidden; }
    .pct-fill2 { height: 100%; border-radius: 20px; }

    .info-tbl2 td, .info-tbl2 th { font-size: 0.82rem; padding: 7px 10px; border-color: #f5f3ff; }
    .info-tbl2 th { color: #6b7280; font-weight: 600; width: 40%; }

    .pet-banner {
        border-radius: 16px;
        background: linear-gradient(135deg, #4c1d95 0%, #7c3aed 60%, #8b5cf6 100%);
        color: #fff; padding: 1.3rem 1.6rem;
        position: relative; overflow: hidden; border: none;
        box-shadow: 0 4px 15px rgba(76,29,149,0.3);
    }
    .pet-banner::before { content:''; position:absolute; top:-40px; right:-40px; width:150px; height:150px; background:rgba(255,255,255,0.07); border-radius:50%; }
    .pet-banner::after  { content:''; position:absolute; bottom:-60px; right:30px; width:180px; height:180px; background:rgba(139,92,246,0.2); border-radius:50%; }
</style>
@endsection

@section('content')

{{-- STAT CARDS --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card stat-card-pet grad-violet">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="p-label">Total Aspirasi</div>
                        <h3 class="p-value">{{ $totalAspirasi }}</h3>
                    </div>
                    <div class="p-icon"><i class="ph ph-stack"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card-pet grad-rose2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="p-label">Menunggu</div>
                        <h3 class="p-value">{{ $aspirasiMenunggu }}</h3>
                    </div>
                    <div class="p-icon"><i class="ph ph-hourglass-medium"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card-pet grad-teal2">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="p-label">Diproses</div>
                        <h3 class="p-value">{{ $aspirasiProses }}</h3>
                    </div>
                    <div class="p-icon"><i class="ph ph-arrows-clockwise"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card-pet grad-lime">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="p-label">Selesai</div>
                        <h3 class="p-value">{{ $aspirasiSelesai }}</h3>
                    </div>
                    <div class="p-icon"><i class="ph ph-check-fat"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TABLE + SIDEBAR --}}
<div class="row g-3 mb-3">
    <div class="col-md-8">
        <div class="card card-pet">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-hdr-icon" style="background:linear-gradient(135deg,#4c1d95,#8b5cf6);">
                        <i class="ph ph-list-checks"></i>
                    </div>
                    <h6 class="mb-0 fw-bold" style="font-size:0.9rem;">Aspirasi Aktif</h6>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table tbl-pet mb-0">
                        <thead>
                            <tr>
                                <th>ID</th><th>Pengirim</th><th>Kategori</th><th>Ruangan</th><th>Status</th><th>Tanggal</th><th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasiAktif as $a)
                            <tr>
                                <td><span style="font-size:0.75rem;color:#9ca3af;">#{{ $a->id_aspirasi }}</span></td>
                                <td>
                                    @php $pengirim = $a->user->siswa ?? $a->user->guru; @endphp
                                    <span style="font-weight:600;">{{ $pengirim->nama ?? $a->user->email }}</span>
                                    <br><small class="text-muted">{{ $pengirim->kelas ?? $pengirim->jabatan ?? '-' }}</small>
                                </td>
                                <td>{{ $a->kategori->nama_kategori ?? '-' }}</td>
                                <td>{{ $a->ruangan->nama_ruangan ?? $a->lokasi }}</td>
                                <td>
                                    @php
                                        $sc = $a->status == 'Proses'
                                            ? ['bg'=>'#ccfbf1','col'=>'#134e4a']
                                            : ['bg'=>'#ffe4e6','col'=>'#881337'];
                                    @endphp
                                    <span class="badge" style="background:{{ $sc['bg'] }};color:{{ $sc['col'] }};border-radius:20px;font-size:0.72rem;padding:4px 10px;">{{ $a->status }}</span>
                                </td>
                                <td style="color:#6b7280;font-size:0.78rem;">{{ $a->created_at ? $a->created_at->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <a href="{{ route('petugas.aspirasi.detail', $a->id_aspirasi) }}" class="btn btn-sm" style="background:linear-gradient(135deg,#134e4a,#2dd4bf);color:#fff;border-radius:8px;padding:4px 10px;font-size:0.75rem;">
                                        <i class="ph ph-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="ph ph-inbox" style="font-size:2rem;display:block;margin-bottom:8px;"></i>
                                    Tidak ada aspirasi aktif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-3 text-center" style="border-top:1px solid #f5f3ff;">
                    <a href="{{ route('petugas.aspirasi.index') }}" class="btn btn-sm" style="background:linear-gradient(135deg,#4c1d95,#8b5cf6);color:#fff;border-radius:20px;padding:6px 20px;font-size:0.8rem;">
                        <i class="ph ph-list"></i> Lihat Semua Aspirasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-pet mb-3">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-hdr-icon" style="background:linear-gradient(135deg,#881337,#fb7185);">
                        <i class="ph ph-chart-donut"></i>
                    </div>
                    <h6 class="mb-0 fw-bold" style="font-size:0.9rem;">Persentase Status</h6>
                </div>
            </div>
            <div class="card-body" style="padding:1rem 1.4rem;">
                @php
                    $total = $totalAspirasi > 0 ? $totalAspirasi : 1;
                    $persenMenunggu = round(($aspirasiMenunggu / $total) * 100);
                    $persenProses   = round(($aspirasiProses / $total) * 100);
                    $persenSelesai  = round(($aspirasiSelesai / $total) * 100);
                @endphp
                <div class="pct-row2">
                    <div class="pct-top2">
                        <span class="pct-label2"><i class="ph ph-hourglass" style="color:#fb7185;"></i> Menunggu</span>
                        <span class="pct-val2" style="color:#be185d;">{{ $persenMenunggu }}%</span>
                    </div>
                    <div class="pct-track2"><div class="pct-fill2" style="width:{{ $persenMenunggu }}%;background:linear-gradient(90deg,#881337,#fb7185);"></div></div>
                </div>
                <div class="pct-row2">
                    <div class="pct-top2">
                        <span class="pct-label2"><i class="ph ph-arrows-clockwise" style="color:#2dd4bf;"></i> Diproses</span>
                        <span class="pct-val2" style="color:#0f766e;">{{ $persenProses }}%</span>
                    </div>
                    <div class="pct-track2"><div class="pct-fill2" style="width:{{ $persenProses }}%;background:linear-gradient(90deg,#134e4a,#2dd4bf);"></div></div>
                </div>
                <div class="pct-row2" style="margin-bottom:0;">
                    <div class="pct-top2">
                        <span class="pct-label2"><i class="ph ph-check-circle" style="color:#a3e635;"></i> Selesai</span>
                        <span class="pct-val2" style="color:#3f6212;">{{ $persenSelesai }}%</span>
                    </div>
                    <div class="pct-track2"><div class="pct-fill2" style="width:{{ $persenSelesai }}%;background:linear-gradient(90deg,#3f6212,#a3e635);"></div></div>
                </div>
            </div>
        </div>

        <div class="card card-pet">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="p-hdr-icon" style="background:linear-gradient(135deg,#4c1d95,#8b5cf6);">
                        <i class="ph ph-identification-badge"></i>
                    </div>
                    <h6 class="mb-0 fw-bold" style="font-size:0.9rem;">Informasi Petugas</h6>
                </div>
            </div>
            <div class="card-body" style="padding:0.8rem 1.4rem;">
                <table class="table info-tbl2 mb-0">
                    <tr><th>Nama</th><td>{{ $petugas->nama }}</td></tr>
                    <tr><th>NIP</th><td>{{ $petugas->nip ?? '-' }}</td></tr>
                    <tr>
                        <th>Status</th>
                        <td><span class="badge bg-{{ $petugas->status_badge }}" style="font-size:0.73rem;">{{ $petugas->status }}</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- WELCOME BANNER --}}
<div class="row">
    <div class="col-12">
        <div class="pet-banner">
            <div style="position:relative;z-index:1;">
                <div style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.2);border-radius:20px;padding:4px 12px;font-size:0.75rem;margin-bottom:10px;">
                    <i class="ph ph-shield-check" style="color:#c4b5fd;"></i> Petugas
                </div>
                <h5 style="font-size:1rem;font-weight:700;margin-bottom:4px;">Selamat Datang, {{ $petugas->nama }} <i class="ph ph-hand-waving" style="color:#c4b5fd;"></i></h5>
                <p style="font-size:0.83rem;opacity:0.78;margin:0;">Kelola dan tindak lanjuti aspirasi yang masuk melalui menu yang tersedia.</p>
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
                        datasets: [{ label: 'Jumlah Aspirasi', data: data, backgroundColor: 'rgba(139,92,246,0.7)', borderColor: '#7c3aed', borderWidth: 1, borderRadius: 5 }]
                    },
                    options: { responsive: true, maintainAspectRatio: true, plugins: { legend: { position: 'top' } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
                });
            }
        }
    });
</script>
@endpush