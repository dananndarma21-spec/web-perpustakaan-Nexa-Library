<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Buku</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Tambah Buku Baru</h1>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-8">
        <div class="glass-card p-8">
            <form method="POST" action="{{ route('bukus.store') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf

                <!-- Judul -->
                <div>
                    <label for="judul" class="input-label">📖 Judul Buku</label>
                    <input 
                        type="text" 
                        name="judul" 
                        id="judul" 
                        value="{{ old('judul') }}" 
                        class="input-field" 
                        placeholder="Masukkan judul buku"
                        required
                    >
                    @error('judul')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penulis -->
                <div>
                    <label for="penulis" class="input-label">✍️ Nama Penulis</label>
                    <input 
                        type="text" 
                        name="penulis" 
                        id="penulis" 
                        value="{{ old('penulis') }}" 
                        class="input-field" 
                        placeholder="Masukkan nama penulis"
                        required
                    >
                    @error('penulis')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tahun Terbit -->
                <div>
                    <label for="tahun_terbit" class="input-label">📅 Tahun Terbit</label>
                    <input 
                        type="number" 
                        name="tahun_terbit" 
                        id="tahun_terbit" 
                        value="{{ old('tahun_terbit') }}" 
                        class="input-field" 
                        placeholder="Contoh: 2023"
                        required
                    >
                    @error('tahun_terbit')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
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
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stok -->
                <div>
                    <label for="stok" class="input-label">📦 Jumlah Stok</label>
                    <input 
                        type="number" 
                        name="stok" 
                        id="stok" 
                        value="{{ old('stok') }}" 
                        class="input-field" 
                        placeholder="Masukkan jumlah stok"
                        required
                    >
                    @error('stok')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar Cover -->
                <div>
                    <label for="gambar" class="input-label">🖼️ Cover Buku</label>
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
                    @error('gambar')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
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
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6">
                    <a 
                        href="{{ route('bukus.index') }}" 
                        class="flex-1 btn-secondary text-center"
                    >
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="flex-1 btn-primary"
                    >
                        ✓ Simpan Buku
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
</x-app-layout>