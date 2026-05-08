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
                <h1 class="mt-3 text-3xl font-semibold text-white">Edit Data Buku</h1>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="max-w-2xl mx-auto space-y-8">
        <div class="glass-card p-8">
            <form method="POST" action="<?php echo e(route('bukus.update', $buku)); ?>" class="space-y-6" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Judul -->
                <div>
                    <label for="judul" class="input-label">📖 Judul Buku</label>
                    <input 
                        type="text" 
                        name="judul" 
                        id="judul" 
                        value="<?php echo e(old('judul', $buku->judul)); ?>" 
                        class="input-field" 
                        placeholder="Masukkan judul buku"
                        required
                    >
                    <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="input-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="input-label">✍️ Nama Penulis</label>
                    <input 
                        type="text" 
                        name="penulis" 
                        id="penulis" 
                        value="<?php echo e(old('penulis', $buku->penulis)); ?>" 
                        class="input-field" 
                        placeholder="Masukkan nama penulis"
                        required
                    >
                    <?php $__errorArgs = ['penulis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="input-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Tahun Terbit -->
                <div>
                    <label for="tahun_terbit" class="input-label">📅 Tahun Terbit</label>
                    <input 
                        type="number" 
                        name="tahun_terbit" 
                        id="tahun_terbit" 
                        value="<?php echo e(old('tahun_terbit', $buku->tahun_terbit)); ?>" 
                        class="input-field" 
                        placeholder="Contoh: 2023"
                        required
                    >
                    <?php $__errorArgs = ['tahun_terbit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="input-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori_id" class="input-label">📚 Kategori</label>
                    <select 
                        name="kategori_id" 
                        id="kategori_id" 
                        class="input-field" 
                        required
                    >
                        <option value="">-- Pilih Kategori --</option>
                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kategori->id); ?>" <?php echo e(old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : ''); ?>>
                                <?php echo e($kategori->nama_kategori); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['kategori_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="input-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Stok -->
                <div>
                    <label for="stok" class="input-label">📦 Jumlah Stok</label>
                    <input 
                        type="number" 
                        name="stok" 
                        id="stok" 
                        value="<?php echo e(old('stok', $buku->stok)); ?>" 
                        class="input-field" 
                        placeholder="Masukkan jumlah stok"
                        required
                    >
                    <?php $__errorArgs = ['stok'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="input-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Gambar Cover -->
                <div>
                    <label for="gambar" class="input-label">🖼️ Cover Buku</label>
                    <?php if($buku->gambar): ?>
                        <div class="mb-3 flex items-center gap-4">
                            <img src="<?php echo e(asset('storage/' . $buku->gambar)); ?>" alt="<?php echo e($buku->judul); ?>" class="w-20 h-28 object-cover rounded-xl border border-white/10 shadow-lg">
                            <p class="text-xs text-slate-400">Cover saat ini. Upload baru untuk mengganti.</p>
                        </div>
                    <?php endif; ?>
                    <input 
                        type="file" 
                        name="gambar" 
                        id="gambar" 
                        accept="image/*"
                        class="input-field file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-500/20 file:text-violet-300 hover:file:bg-violet-500/30"
                        onchange="previewImage(event)"
                    >
                    <div id="image-preview" class="mt-3 hidden">
                        <img id="preview-img" src="" alt="Preview" class="w-24 h-32 object-cover rounded-xl border border-white/10 shadow-lg">
                    </div>
                    <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="input-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="input-label">📝 Deskripsi / Artikel Buku</label>
                    <textarea 
                        name="deskripsi" 
                        id="deskripsi" 
                        rows="5" 
                        class="input-field" 
                        placeholder="Tulis sinopsis atau deskripsi buku..."
                    ><?php echo e(old('deskripsi', $buku->deskripsi)); ?></textarea>
                    <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="input-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6">
                    <a 
                        href="<?php echo e(route('bukus.index')); ?>" 
                        class="flex-1 btn-secondary text-center"
                    >
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="flex-1 btn-primary"
                    >
                        ✓ Perbarui Buku
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }
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
<?php endif; ?><?php /**PATH C:\Users\Danan\Downloads\TUGAS-MIGRATION4\TUGAS-MIGRATION\resources\views/bukus/edit.blade.php ENDPATH**/ ?>