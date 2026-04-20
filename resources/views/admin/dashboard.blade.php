@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('styles')
<style>
    .stat-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.18);
    }
    .stat-card .card-body {
        padding: 1.5rem;
    }
    .stat-card .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        background: rgba(255,255,255,0.22);
        flex-shrink: 0;
    }
    .stat-card .stat-label {
        font-size: 0.78rem;
        font-weight: 600;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        opacity: 0.88;
        margin-bottom: 4px;
    }
    .stat-card .stat-value {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        margin: 0;
    }
    .stat-card .stat-footer {
        margin-top: 12px;
        padding-top: 10px;
        border-top: 1px solid rgba(255,255,255,0.2);
        font-size: 0.75rem;
        opacity: 0.82;
    }

    /* Gradient warna berbeda dari Farhan */
    .grad-teal    { background: linear-gradient(135deg, #0f9b8e 0%, #00c9b1 100%); color:#fff; }
    .grad-indigo  { background: linear-gradient(135deg, #4e54c8 0%, #8f94fb 100%); color:#fff; }
    .grad-coral   { background: linear-gradient(135deg, #e85d04 0%, #f48c06 100%); color:#fff; }
    .grad-rose    { background: linear-gradient(135deg, #b5179e 0%, #7209b7 100%); color:#fff; }

    /* Status aspirasi card */
    .status-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .status-row:last-child { border-bottom: none; }
    .status-dot {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .status-label { flex: 1; font-weight: 500; font-size: 0.88rem; }
    .status-count {
        font-weight: 700;
        font-size: 1.1rem;
        min-width: 30px;
        text-align: right;
    }
    .status-bar-wrap { width: 80px; }

    /* Chart bar */
    .chart-bar-wrap .bar-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }
    .chart-bar-wrap .bar-label {
        width: 90px;
        font-size: 0.78rem;
        color: #555;
        flex-shrink: 0;
    }
    .chart-bar-wrap .bar-track {
        flex: 1;
        background: #f0f0f0;
        border-radius: 20px;
        height: 14px;
        overflow: hidden;
    }
    .chart-bar-wrap .bar-fill {
        height: 100%;
        border-radius: 20px;
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        transition: width 0.5s ease;
    }
    .chart-bar-wrap .bar-count {
        width: 40px;
        text-align: right;
        font-size: 0.78rem;
        font-weight: 700;
        color: #333;
        flex-shrink: 0;
    }

    /* Welcome banner */
    .welcome-banner {
        border-radius: 16px;
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
        color: #fff;
        padding: 1.5rem 2rem;
        position: relative;
        overflow: hidden;
        border: none;
    }
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 160px; height: 160px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -50px; right: 60px;
        width: 200px; height: 200px;
        background: rgba(79,84,200,0.18);
        border-radius: 50%;
    }
    .welcome-banner h5 { font-size: 1.1rem; font-weight: 700; margin-bottom: 4px; }
    .welcome-banner p { font-size: 0.85rem; opacity: 0.78; margin: 0; }
    .welcome-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 0.75rem;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')

{{-- ══════ STAT CARDS ══════ --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card stat-card grad-teal">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Siswa</div>
                        <h3 class="stat-value">{{ $totalSiswa }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="ph ph-student"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="ph ph-arrow-right"></i> Data terdaftar
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card grad-indigo">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Guru</div>
                        <h3 class="stat-value">{{ $totalGuru }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="ph ph-chalkboard-teacher"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="ph ph-arrow-right"></i> Tenaga pengajar
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card grad-coral">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Aspirasi</div>
                        <h3 class="stat-value">{{ $totalAspirasi }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="ph ph-chat-circle-dots"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="ph ph-arrow-right"></i> Semua status
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card grad-rose">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="stat-label">Total Admin</div>
                        <h3 class="stat-value">{{ $totalAdmin }}</h3>
                    </div>
                    <div class="stat-icon">
                        <i class="ph ph-shield-check"></i>
                    </div>
                </div>
                <div class="stat-footer">
                    <i class="ph ph-arrow-right"></i> Akun administrator
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══════ ROW 2 : STATUS + GRAFIK ══════ --}}
<div class="row g-3 mb-4">

    {{-- Status Aspirasi --}}
    <div class="col-md-4">
        <div class="card" style="border-radius:16px; border:none; box-shadow:0 4px 15px rgba(0,0,0,0.07); height:100%;">
            <div class="card-header" style="border-radius:16px 16px 0 0; border:none; background:#fff; padding:1.2rem 1.4rem 0.5rem;">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,#4e54c8,#8f94fb);display:flex;align-items:center;justify-content:center;color:#fff;">
                        <i class="ph ph-chart-pie-slice"></i>
                    </div>
                    <h6 class="mb-0 fw-bold" style="font-size:0.92rem;">Status Aspirasi</h6>
                </div>
            </div>
            <div class="card-body" style="padding:1rem 1.4rem;">

                <div class="status-row">
                    <div class="status-dot" style="background:#fff8e1;">
                        <i class="ph ph-hourglass" style="color:#f59e0b;"></i>
                    </div>
                    <span class="status-label">Menunggu</span>
                    <div class="status-bar-wrap">
                        <div class="progress" style="height:6px;border-radius:10px;">
                            <div class="progress-bar" style="background:#f59e0b; width: {{ $totalAspirasi > 0 ? ($aspirasiMenunggu/$totalAspirasi)*100 : 0 }}%;"></div>
                        </div>
                    </div>
                    <span class="status-count" style="color:#f59e0b;">{{ $aspirasiMenunggu }}</span>
                </div>

                <div class="status-row">
                    <div class="status-dot" style="background:#e0f2fe;">
                        <i class="ph ph-arrows-clockwise" style="color:#0ea5e9;"></i>
                    </div>
                    <span class="status-label">Diproses</span>
                    <div class="status-bar-wrap">
                        <div class="progress" style="height:6px;border-radius:10px;">
                            <div class="progress-bar" style="background:#0ea5e9; width: {{ $totalAspirasi > 0 ? ($aspirasiProses/$totalAspirasi)*100 : 0 }}%;"></div>
                        </div>
                    </div>
                    <span class="status-count" style="color:#0ea5e9;">{{ $aspirasiProses }}</span>
                </div>

                <div class="status-row">
                    <div class="status-dot" style="background:#d1fae5;">
                        <i class="ph ph-check-circle" style="color:#10b981;"></i>
                    </div>
                    <span class="status-label">Selesai</span>
                    <div class="status-bar-wrap">
                        <div class="progress" style="height:6px;border-radius:10px;">
                            <div class="progress-bar" style="background:#10b981; width: {{ $totalAspirasi > 0 ? ($aspirasiSelesai/$totalAspirasi)*100 : 0 }}%;"></div>
                        </div>
                    </div>
                    <span class="status-count" style="color:#10b981;">{{ $aspirasiSelesai }}</span>
                </div>

                {{-- Total ringkasan --}}
                <div style="margin-top:14px; padding:10px 14px; background:#f8f9ff; border-radius:10px; text-align:center;">
                    <span style="font-size:0.75rem; color:#888;">Total Keseluruhan</span>
                    <div style="font-size:1.6rem; font-weight:800; color:#4e54c8;">{{ $totalAspirasi }}</div>
                    <span style="font-size:0.7rem; color:#aaa;">aspirasi tercatat</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Aspirasi per Bulan --}}
    <div class="col-md-8">
        <div class="card" style="border-radius:16px; border:none; box-shadow:0 4px 15px rgba(0,0,0,0.07); height:100%;">
            <div class="card-header" style="border-radius:16px 16px 0 0; border:none; background:#fff; padding:1.2rem 1.4rem 0.5rem;">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:32px;height:32px;border-radius:9px;background:linear-gradient(135deg,#e85d04,#f48c06);display:flex;align-items:center;justify-content:center;color:#fff;">
                        <i class="ph ph-chart-bar"></i>
                    </div>
                    <h6 class="mb-0 fw-bold" style="font-size:0.92rem;">Grafik Aspirasi per Bulan</h6>
                </div>
            </div>
            <div class="card-body" style="padding:1rem 1.4rem;">
                @if(isset($bulanLabels) && count($bulanLabels) > 0)
                    <div class="chart-bar-wrap" style="overflow-x:auto;">
                        <div style="min-width:360px;">
                            @foreach($bulanLabels as $index => $label)
                            <div class="bar-row">
                                <span class="bar-label">{{ $label }}</span>
                                <div class="bar-track">
                                    @php
                                        $maxData = max($bulanData) > 0 ? max($bulanData) : 1;
                                        $persen  = ($bulanData[$index] / $maxData) * 100;
                                    @endphp
                                    <div class="bar-fill" style="width: {{ $persen }}%;"></div>
                                </div>
                                <span class="bar-count">{{ $bulanData[$index] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="ph ph-chart-line" style="font-size:3rem; color:#ccc;"></i>
                        <p class="mt-2 text-muted" style="font-size:0.85rem;">Belum ada data untuk grafik</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- ══════ WELCOME BANNER ══════ --}}
<div class="row">
    <div class="col-12">
        <div class="welcome-banner">
            <div style="position:relative;z-index:1;">
                <div class="welcome-badge">
                    <i class="ph ph-star" style="color:#fbbf24;"></i>
                    <span>Administrator</span>
                </div>
                <h5>Selamat Datang, {{ Auth::user()->email }} <i class="ph ph-hand-waving" style="color:#fbbf24;"></i></h5>
                <p>Anda login sebagai <strong>Administrator</strong>. Silakan kelola data siswa, guru, kategori, dan aspirasi melalui menu yang tersedia.</p>
            </div>
        </div>
    </div>
</div>

@endsection
