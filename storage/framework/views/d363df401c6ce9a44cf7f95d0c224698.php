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
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Buku</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Kelola Koleksi Buku</h1>
            </div>
            <a href="<?php echo e(route('bukus.create')); ?>" class="btn-primary">+ Tambah Buku Baru</a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="space-y-6">
        <div class="glass-card p-5 flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div>
                <p class="text-sm text-slate-400">Lihat detail buku, kategori, stok, dan tindakan langsung dalam tabel premium.</p>
            </div>
            <form method="GET" action="<?php echo e(route('bukus.index')); ?>" class="flex w-full gap-3 max-w-2xl">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari judul, penulis, kategori..." class="search-input" />
                <button type="submit" class="btn-secondary">Cari</button>
            </form>
        </div>

        <div class="table-panel">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="table-cell">Cover</th>
                            <th class="table-cell">Judul</th>
                            <th class="table-cell">Penulis</th>
                            <th class="table-cell">Tahun</th>
                            <th class="table-cell">Kategori</th>
                            <th class="table-cell">Stok</th>
                            <th class="table-cell text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $bukus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="table-row group" id="buku-row-<?php echo e($buku->id); ?>">
                                <td class="table-cell">
                                    <?php if($buku->gambar): ?>
                                        <img src="<?php echo e(asset('storage/' . $buku->gambar)); ?>" alt="<?php echo e($buku->judul); ?>" class="w-12 h-16 object-cover rounded-lg border border-white/10 shadow-lg">
                                    <?php else: ?>
                                        <div class="w-12 h-16 rounded-lg bg-gradient-to-br from-violet-500/20 to-fuchsia-500/20 border border-white/10 flex items-center justify-center">
                                            <i class="fa-solid fa-book text-violet-400/60 text-lg"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="table-cell">
                                    <a href="<?php echo e(route('bukus.show', $buku)); ?>" class="font-semibold text-white hover:text-violet-300 transition-colors">
                                        <?php echo e($buku->judul); ?>

                                    </a>
                                </td>
                                <td class="table-cell"><?php echo e($buku->penulis); ?></td>
                                <td class="table-cell"><?php echo e($buku->tahun_terbit); ?></td>
                                <td class="table-cell"><?php echo e($buku->kategori?->nama_kategori ?? 'N/A'); ?></td>
                                <td class="table-cell">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold <?php echo e($buku->stok > 0 ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border border-rose-500/20'); ?>">
                                        <?php echo e($buku->stok); ?>

                                    </span>
                                </td>
                                <td class="table-cell text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="<?php echo e(route('bukus.show', $buku)); ?>" class="btn-detail">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </a>
                                        <a href="<?php echo e(route('bukus.edit', $buku)); ?>" class="btn-edit">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <button type="button" class="btn-delete" onclick="confirmDelete('<?php echo e(route('bukus.destroy', $buku)); ?>', 'buku-row-<?php echo e($buku->id); ?>')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="table-cell text-center" colspan="7">Tidak ada buku tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <?php echo e($bukus->appends(request()->query())->links()); ?>

        </div>
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
<?php endif; ?><?php /**PATH C:\Users\Danan\Downloads\TUGAS-MIGRATION4\TUGAS-MIGRATION\resources\views/bukus/index.blade.php ENDPATH**/ ?>