<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<style>
/* ===== DASHBOARD SPECIFIC STYLES ===== */
.welcome-banner {
    position: relative;
    padding: 32px;
    border-radius: 24px;
    background: linear-gradient(135deg, rgba(139,92,246,0.12), rgba(99,102,241,0.08), rgba(168,85,247,0.06));
    border: 1px solid rgba(139,92,246,0.15);
    overflow: hidden;
    margin-bottom: 28px;
}
.welcome-banner::before {
    content: '';
    position: absolute;
    top: -50%; right: -20%;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(139,92,246,0.15), transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}
.welcome-banner h1 {
    font-size: 26px; font-weight: 700; color: #fff;
    margin-bottom: 6px; position: relative;
}
.welcome-banner p {
    font-size: 14px; color: #94a3b8; position: relative;
}

/* STATS */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 28px;
}
.stat-card {
    padding: 24px;
    border-radius: 20px;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.06);
    backdrop-filter: blur(12px);
    transition: all 0.3s cubic-bezier(.4,0,.2,1);
    position: relative;
    overflow: hidden;
}
.stat-card::after {
    content: '';
    position: absolute;
    top: -25px; right: -15px;
    width: 70px; height: 70px;
    border-radius: 50%;
    opacity: 0.1;
    background: var(--card-accent);
}
.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 40px rgba(var(--card-shadow), 0.2);
    border-color: rgba(var(--card-shadow), 0.25);
}
.stat-icon {
    width: 44px; height: 44px;
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    margin-bottom: 16px;
}
.stat-number { font-size: 30px; font-weight: 700; color: #fff; line-height: 1; }
.stat-label { font-size: 13px; color: #64748b; margin-top: 6px; }
.stat-card.purple { --card-accent: #a78bfa; --card-shadow: 139,92,246; }
.stat-card.purple .stat-icon { background: rgba(167,139,250,0.12); color: #a78bfa; }
.stat-card.blue { --card-accent: #60a5fa; --card-shadow: 96,165,250; }
.stat-card.blue .stat-icon { background: rgba(96,165,250,0.12); color: #60a5fa; }
.stat-card.green { --card-accent: #34d399; --card-shadow: 52,211,153; }
.stat-card.green .stat-icon { background: rgba(52,211,153,0.12); color: #34d399; }
.stat-card.orange { --card-accent: #fb923c; --card-shadow: 251,146,60; }
.stat-card.orange .stat-icon { background: rgba(251,146,60,0.12); color: #fb923c; }

/* ROW LAYOUT */
.row-layout {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
    margin-bottom: 24px;
}

/* CARD GLASS */
.card-glass {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.06);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    padding: 24px;
}
.card-glass h5 {
    font-size: 14px; font-weight: 600; color: #cbd5e1;
    margin-bottom: 18px;
    display: flex; align-items: center; gap: 8px;
}
.card-glass h5 i { color: #a78bfa; font-size: 14px; }

/* ACTIVITY */
.activity-item {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.04);
    font-size: 13px; color: #94a3b8;
}
.activity-item:last-child { border-bottom: none; }
.activity-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: linear-gradient(135deg, #8b5cf6, #a855f7);
    flex-shrink: 0;
    box-shadow: 0 0 8px rgba(139,92,246,0.4);
}
.activity-time { margin-left: auto; font-size: 11px; color: #475569; }

/* TABLE */
.table-custom { width: 100%; border-collapse: collapse; font-size: 13px; }
.table-custom th {
    text-align: left; padding: 12px 16px;
    color: #475569; font-weight: 500; font-size: 11px;
    text-transform: uppercase; letter-spacing: 0.08em;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.table-custom td {
    padding: 12px 16px; color: #cbd5e1;
    border-bottom: 1px solid rgba(255,255,255,0.03);
}
.table-custom tr:hover td { background: rgba(255,255,255,0.02); }
.badge {
    padding: 4px 12px; border-radius: 20px;
    font-size: 11px; font-weight: 600;
}
.badge-success { background: rgba(52,211,153,0.12); color: #34d399; }
.badge-warning { background: rgba(251,191,36,0.12); color: #fbbf24; }

@media (max-width: 900px) {
    .row-layout { grid-template-columns: 1fr; }
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 500px) {
    .stats-grid { grid-template-columns: 1fr; }
}
</style>

<!-- Welcome Banner -->
<div class="welcome-banner">
    <div style="display:flex; align-items:center; gap:16px; margin-bottom:8px;">
        <img src="<?php echo e(asset('images/nexa-library-logo.png')); ?>" alt="Nexa Library" style="width:48px; height:48px; object-fit:contain; filter: drop-shadow(0 0 12px rgba(139,92,246,0.3));">
        <h1 style="margin-bottom:0;">Selamat datang, <?php echo e(auth()->user()->name); ?>! 👋</h1>
    </div>
    <p>Pantau aktivitas perpustakaan dan kelola data dengan mudah di <strong style="color:#a78bfa;">Nexa Library</strong>.</p>
</div>

<!-- STATS -->
<div class="stats-grid">
    <div class="stat-card purple">
        <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
        <div class="stat-number"><?php echo e($totalSiswa); ?></div>
        <div class="stat-label">Total Siswa</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-icon"><i class="fa-solid fa-tags"></i></div>
        <div class="stat-number"><?php echo e($totalKategori); ?></div>
        <div class="stat-label">Total Kategori</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon"><i class="fa-solid fa-book"></i></div>
        <div class="stat-number"><?php echo e($totalBuku); ?></div>
        <div class="stat-label">Total Buku</div>
    </div>
    <div class="stat-card orange">
        <div class="stat-icon"><i class="fa-solid fa-arrow-right-arrow-left"></i></div>
        <div class="stat-number"><?php echo e($totalPeminjaman); ?></div>
        <div class="stat-label">Total Peminjaman</div>
    </div>
</div>

<!-- CHART + ACTIVITY -->
<div class="row-layout">
    <div class="card-glass">
        <h5><i class="fa-solid fa-chart-line"></i> Grafik Peminjaman (7 Hari Terakhir)</h5>
        <canvas id="chart" height="100"></canvas>
    </div>
    <div class="card-glass">
        <h5><i class="fa-regular fa-clock"></i> Aktivitas Terbaru</h5>
        <?php $__empty_1 = true; $__currentLoopData = $recentPeminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="activity-item">
            <div class="activity-dot"></div>
            <span><strong><?php echo e($item->siswa->nama ?? '-'); ?></strong> meminjam <em><?php echo e($item->buku->judul ?? '-'); ?></em></span>
            <span class="activity-time"><?php echo e($item->created_at->diffForHumans()); ?></span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="activity-item">
            <div class="activity-dot"></div>
            <span>Belum ada aktivitas</span>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- TABLE -->
<div class="card-glass">
    <h5><i class="fa-solid fa-list"></i> Peminjaman Aktif</h5>
    <table class="table-custom">
        <thead>
            <tr>
                <th>#</th>
                <th>Siswa</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $aktivPeminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($i + 1); ?></td>
                <td><?php echo e($p->siswa->nama ?? '-'); ?></td>
                <td><?php echo e($p->buku->judul ?? '-'); ?></td>
                <td><?php echo e($p->tanggal_pinjam); ?></td>
                <td><?php echo e($p->tanggal_kembali ?? '-'); ?></td>
                <td>
                    <?php if($p->status === 'dipinjam'): ?>
                        <span class="badge badge-warning">Dipinjam</span>
                    <?php else: ?>
                        <span class="badge badge-success">Dikembalikan</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" style="text-align:center;color:#475569;padding:24px;">
                    Tidak ada peminjaman aktif
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chart');
const chartLabels = <?php echo json_encode($chartLabels, 15, 512) ?>;
const chartData   = <?php echo json_encode($chartData, 15, 512) ?>;

new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartLabels,
        datasets: [{
            label: 'Peminjaman',
            data: chartData,
            borderColor: '#8b5cf6',
            backgroundColor: 'rgba(139,92,246,0.1)',
            pointBackgroundColor: '#a78bfa',
            pointBorderColor: '#8b5cf6',
            pointRadius: 5,
            pointHoverRadius: 7,
            tension: 0.4,
            fill: true,
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { color: '#94a3b8', font: { family: 'Inter, Poppins' } } }
        },
        scales: {
            x: { ticks: { color: '#475569' }, grid: { color: 'rgba(255,255,255,0.03)' } },
            y: { ticks: { color: '#475569' }, grid: { color: 'rgba(255,255,255,0.03)' }, beginAtZero: true }
        }
    }
});
</script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Danan\Downloads\TUGAS-MIGRATION4\TUGAS-MIGRATION\resources\views/dashboard.blade.php ENDPATH**/ ?>