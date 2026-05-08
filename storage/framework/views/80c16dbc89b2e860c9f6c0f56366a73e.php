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
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Siswa</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Kelola Data Siswa</h1>
            </div>
            <a href="<?php echo e(route('siswas.create')); ?>" class="btn-primary">+ Tambah Siswa Baru</a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="space-y-6">
        <div class="glass-card p-5 flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div>
                <p class="text-sm text-slate-400">Data siswa terstruktur dalam tabel modern dengan pencarian instan.</p>
            </div>
            <form method="GET" action="<?php echo e(route('siswas.index')); ?>" class="flex w-full gap-3 max-w-2xl">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari siswa, NIS, kelas..." class="search-input" />
                <button type="submit" class="btn-secondary">Cari</button>
            </form>
        </div>

        <div class="table-panel">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="table-cell">ID</th>
                            <th class="table-cell">Nama</th>
                            <th class="table-cell">NIS</th>
                            <th class="table-cell">Kelas</th>
                            <th class="table-cell">Jurusan</th>
                            <th class="table-cell text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $siswas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="table-row group" id="siswa-row-<?php echo e($siswa->id); ?>">
                                <td class="table-cell font-mono text-xs text-slate-500">#<?php echo e($siswa->id); ?></td>
                                <td class="table-cell font-semibold text-white"><?php echo e($siswa->nama); ?></td>
                                <td class="table-cell"><?php echo e($siswa->nis); ?></td>
                                <td class="table-cell"><?php echo e($siswa->kelas); ?></td>
                                <td class="table-cell"><?php echo e($siswa->jurusan); ?></td>
                                <td class="table-cell text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="<?php echo e(route('siswas.edit', $siswa)); ?>" class="btn-edit">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <button type="button" class="btn-delete" onclick="confirmDelete('<?php echo e(route('siswas.destroy', $siswa)); ?>', 'siswa-row-<?php echo e($siswa->id); ?>')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td class="table-cell text-center" colspan="6">Tidak ada data siswa.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-end">
            <?php echo e($siswas->appends(request()->query())->links()); ?>

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
<?php endif; ?><?php /**PATH C:\Users\Danan\Downloads\TUGAS-MIGRATION4\TUGAS-MIGRATION\resources\views/siswas/index.blade.php ENDPATH**/ ?>