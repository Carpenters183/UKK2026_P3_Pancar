@extends('layouts.admin')

@section('title', 'Dashboard Siswa')

@section('styles')
<style>
    .stat-card-siswa {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stat-card-siswa:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.18);
    }
    .stat-card-siswa .card-body { padding: 1.3rem 1.5rem; }
    .stat-card-siswa .s-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        background: rgba(255,255,255,0.22);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; flex-shrink: 0;
    }
    .stat-card-siswa .s-label {
        font-size: 0.72rem; font-weight: 600;
        letter-spacing: 0.5px; text-transform: uppercase;
        opacity: 0.85; margin-bottom: 3px;
    }
    .stat-card-siswa .s-value {
        font-size: 1.9rem; font-weight: 800; line-height: 1; margin: 0;
    }

    .grad-navy   { background: linear-gradient(135deg, #1e3a5f 0%, #2d6a9f 100%); color:#fff; }
    .grad-amber  { background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%); color:#fff; }
    .grad-sky    { background: linear-gradient(135deg, #0369a1 0%, #38bdf8 100%); color:#fff; }
    .grad-green  { background: linear-gradient(135deg, #065f46 0%, #10b981 100%); color:#fff; }

    /* Aspirasi list card */
    .aspirasi-item {
        display: flex; align-items: center; gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f3f4f6;
        text-decoration: none; color: inherit;
        transition: background 0.15s;
    }
    .aspirasi-item:last-child { border-bottom: none; }
    .aspirasi-item:hover { background: #fafafa; border-radius: 8px; padding-left: 8px; }
    .aspirasi-item .a-dot {
        width: 40px; height: 40px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; flex-shrink: 0;
    }
    .aspirasi-item .a-title { font-weight: 600; font-size: 0.85rem; color: #1f2937; }
    .aspirasi-item .a-sub   { font-size: 0.75rem; color: #9ca3af; }
    .aspirasi-item .a-badge { margin-left: auto; flex-shrink: 0; }

    .card-section {
        border: none; border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.07);
    }
    .card-section .card-header {
        border-radius: 16px 16px 0 0; border: none;
        background: #fff; padding: 1.1rem 1.4rem 0.6rem;
    }
    .section-title {
        display: flex; align-items: center; gap: 8px;
    }
    .section-title .title-icon {
        width: 30px; height: 30px; border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.95rem; color: #fff;
    }
    .section-title h6 { margin: 0; font-weight: 700; font-size: 0.9rem; }
</style>
@endsection

@section('content')

{{-- ══ STAT CARDS ══ --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="card stat-card-siswa grad-navy">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="s-label">Total Aspirasi</div>
                        <h3 class="s-value">{{ $totalAspirasi }}</h3>
                    </div>
                    <div class="s-icon"><i class="ph ph-chat-circle-dots"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card-siswa grad-amber">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="s-label">Menunggu</div>
                        <h3 class="s-value">{{ $totalMenunggu }}</h3>
                    </div>
                    <div class="s-icon"><i class="ph ph-hourglass"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card-siswa grad-sky">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="s-label">Diproses</div>
                        <h3 class="s-value">{{ $totalProses }}</h3>
                    </div>
                    <div class="s-icon"><i class="ph ph-arrows-clockwise"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="card stat-card-siswa grad-green">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="s-label">Selesai</div>
                        <h3 class="s-value">{{ $totalSelesai }}</h3>
                    </div>
                    <div class="s-icon"><i class="ph ph-check-circle"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ══ LIST ASPIRASI ══ --}}
<div class="row g-3">
    <div class="col-md-7">
        <div class="card card-section">
            <div class="card-header">
                <div class="section-title">
                    <div class="title-icon" style="background:linear-gradient(135deg,#0369a1,#38bdf8);">
                        <i class="ph ph-clock"></i>
                    </div>
                    <h6>Aspirasi Aktif</h6>
                </div>
            </div>
            <div class="card-body" style="padding: 0.5rem 1.4rem 1.2rem;">
                @if($aspirasiAktif->count() > 0)
                    @foreach($aspirasiAktif as $a)
                    <a href="{{ route('siswa.aspirasi.detail', $a->id_aspirasi) }}" class="aspirasi-item">
                        <div class="a-dot" style="background:{{ $a->status == 'Menunggu' ? '#fff8e1' : '#e0f2fe' }};">
                            <i class="ph ph-{{ $a->status == 'Menunggu' ? 'hourglass' : 'arrows-clockwise' }}"
                               style="color:{{ $a->status == 'Menunggu' ? '#f59e0b' : '#0ea5e9' }};"></i>
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="a-title">{{ $a->kategori->nama_kategori ?? '-' }}</div>
                            <div class="a-sub"><i class="ph ph-map-pin" style="font-size:0.7rem;"></i> {{ $a->lokasi }} &bull; {{ $a->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="a-badge">
                            <span class="badge" style="background:{{ $a->status == 'Menunggu' ? '#fef3c7' : '#e0f2fe' }}; color:{{ $a->status == 'Menunggu' ? '#92400e' : '#0c4a6e' }}; border-radius:20px; font-size:0.7rem; padding:4px 10px;">
                                {{ $a->status }}
                            </span>
                        </div>
                    </a>
                    @endforeach
                    <div class="mt-3">
                        <a href="{{ route('siswa.aspirasi.status') }}" class="btn btn-sm" style="background:linear-gradient(135deg,#1e3a5f,#2d6a9f);color:#fff;border-radius:20px;padding:6px 18px;font-size:0.8rem;">
                            <i class="ph ph-list"></i> Lihat Semua
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div style="width:64px;height:64px;border-radius:50%;background:#f0fdf4;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                            <i class="ph ph-check-circle" style="font-size:2rem;color:#10b981;"></i>
                        </div>
                        <p class="text-muted mb-2" style="font-size:0.85rem;">Tidak ada aspirasi aktif</p>
                        <a href="{{ route('siswa.aspirasi.create') }}" class="btn btn-sm" style="background:linear-gradient(135deg,#1e3a5f,#2d6a9f);color:#fff;border-radius:20px;padding:6px 18px;font-size:0.8rem;">
                            <i class="ph ph-plus"></i> Buat Aspirasi
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card card-section">
            <div class="card-header">
                <div class="section-title">
                    <div class="title-icon" style="background:linear-gradient(135deg,#065f46,#10b981);">
                        <i class="ph ph-check-fat"></i>
                    </div>
                    <h6>Aspirasi Selesai</h6>
                </div>
            </div>
            <div class="card-body" style="padding: 0.5rem 1.4rem 1.2rem;">
                @if($aspirasiSelesai->count() > 0)
                    @foreach($aspirasiSelesai as $a)
                    <a href="{{ route('siswa.aspirasi.detail', $a->id_aspirasi) }}" class="aspirasi-item">
                        <div class="a-dot" style="background:#d1fae5;">
                            <i class="ph ph-check-circle" style="color:#10b981;"></i>
                        </div>
                        <div style="flex:1; min-width:0;">
                            <div class="a-title">{{ $a->kategori->nama_kategori ?? '-' }}</div>
                            <div class="a-sub"><i class="ph ph-map-pin" style="font-size:0.7rem;"></i> {{ $a->lokasi }}</div>
                        </div>
                        <div class="a-badge">
                            <span class="badge" style="background:#d1fae5;color:#065f46;border-radius:20px;font-size:0.7rem;padding:4px 10px;">
                                Selesai
                            </span>
                        </div>
                    </a>
                    @endforeach
                    <div class="mt-3">
                        <a href="{{ route('siswa.aspirasi.history') }}" class="btn btn-sm" style="background:linear-gradient(135deg,#065f46,#10b981);color:#fff;border-radius:20px;padding:6px 18px;font-size:0.8rem;">
                            <i class="ph ph-clock-counter-clockwise"></i> Lihat History
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div style="width:64px;height:64px;border-radius:50%;background:#f9fafb;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                            <i class="ph ph-clock-counter-clockwise" style="font-size:2rem;color:#9ca3af;"></i>
                        </div>
                        <p class="text-muted mb-0" style="font-size:0.85rem;">Belum ada aspirasi selesai</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection