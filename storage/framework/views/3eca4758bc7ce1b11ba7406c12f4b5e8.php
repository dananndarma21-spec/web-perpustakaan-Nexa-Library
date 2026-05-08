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
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Detail Buku</p>
                <h1 class="mt-3 text-3xl font-semibold text-white"><?php echo e($buku->judul); ?></h1>
            </div>
            <a href="<?php echo e(route('bukus.index')); ?>" class="btn-secondary">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Book Detail Card -->
        <div class="glass-card overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Cover Image -->
                <div class="md:w-1/3 p-8 flex items-center justify-center bg-gradient-to-br from-violet-500/10 to-fuchsia-500/5">
                    <?php if($buku->gambar): ?>
                        <img src="<?php echo e(asset('storage/' . $buku->gambar)); ?>" alt="<?php echo e($buku->judul); ?>" class="w-48 h-64 object-cover rounded-2xl border border-white/10 shadow-[0_20px_60px_rgba(139,92,246,0.2)] transition-transform duration-300 hover:scale-105">
                    <?php else: ?>
                        <div class="w-48 h-64 rounded-2xl bg-gradient-to-br from-violet-500/20 to-fuchsia-500/20 border border-white/10 flex flex-col items-center justify-center gap-3">
                            <i class="fa-solid fa-book text-violet-400/50 text-5xl"></i>
                            <p class="text-xs text-slate-500">Tidak ada cover</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Book Info -->
                <div class="md:w-2/3 p-8 space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-2"><?php echo e($buku->judul); ?></h2>
                        <p class="text-slate-400">oleh <span class="text-violet-300 font-semibold"><?php echo e($buku->penulis); ?></span></p>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="glass-card p-4 text-center">
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Tahun Terbit</p>
                            <p class="text-lg font-bold text-white"><?php echo e($buku->tahun_terbit); ?></p>
                        </div>
                        <div class="glass-card p-4 text-center">
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Kategori</p>
                            <p class="text-lg font-bold text-violet-300"><?php echo e($buku->kategori?->nama_kategori ?? 'N/A'); ?></p>
                        </div>
                        <div class="glass-card p-4 text-center">
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Stok</p>
                            <p class="text-lg font-bold <?php echo e($buku->stok > 0 ? 'text-emerald-400' : 'text-rose-400'); ?>"><?php echo e($buku->stok); ?></p>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <a href="<?php echo e(route('bukus.edit', $buku)); ?>" class="btn-edit px-6 py-2.5 text-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Edit Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi / Artikel -->
        <?php if($buku->deskripsi): ?>
            <div class="glass-card p-8">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-align-left text-violet-400"></i>
                    Tentang Buku Ini
                </h3>
                <div class="text-slate-300 leading-relaxed whitespace-pre-line"><?php echo e($buku->deskripsi); ?></div>
            </div>
        <?php else: ?>
            <div class="glass-card p-8 text-center">
                <i class="fa-solid fa-file-lines text-slate-600 text-4xl mb-3"></i>
                <p class="text-slate-500">Belum ada deskripsi untuk buku ini.</p>
                <a href="<?php echo e(route('bukus.edit', $buku)); ?>" class="inline-block mt-3 text-sm text-violet-400 hover:text-violet-300 transition-colors">
                    + Tambahkan Deskripsi
                </a>
            </div>
        <?php endif; ?>
    </div>
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
<?php /**PATH C:\Users\Danan\Downloads\TUGAS-MIGRATION4\TUGAS-MIGRATION\resources\views/bukus/show.blade.php ENDPATH**/ ?>