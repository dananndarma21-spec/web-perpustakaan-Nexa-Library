<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Kategori</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Edit Kategori</h1>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-8">
        <!-- Form Card -->
        <div class="glass-card p-8">
            <form method="POST" action="{{ route('kategoris.update', $kategori) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama Kategori -->
                <div>
                    <label for="nama_kategori" class="input-label">📚 Nama Kategori</label>
                    <input 
                        type="text" 
                        name="nama_kategori" 
                        id="nama_kategori" 
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}" 
                        class="input-field" 
                        placeholder="Contoh: Fiksi, Non-Fiksi, Referensi"
                        required
                    >
                    @error('nama_kategori')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div>
                    <label for="keterangan" class="input-label">📝 Keterangan</label>
                    <textarea 
                        name="keterangan" 
                        id="keterangan" 
                        rows="4"
                        class="input-field resize-none" 
                        placeholder="Masukkan deskripsi kategori..."
                    >{{ old('keterangan', $kategori->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6">
                    <a 
                        href="{{ route('kategoris.index') }}" 
                        class="flex-1 btn-secondary text-center"
                    >
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="flex-1 btn-primary"
                    >
                        ✓ Perbarui Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>