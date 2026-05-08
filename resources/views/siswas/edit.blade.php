<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Siswa</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Edit Data Siswa</h1>
            </div>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto space-y-8">
        <!-- Form Card -->
        <div class="glass-card p-8">
            <form method="POST" action="{{ route('siswas.update', $siswa) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div>
                    <label for="nama" class="input-label">👤 Nama Lengkap</label>
                    <input 
                        type="text" 
                        name="nama" 
                        id="nama" 
                        value="{{ old('nama', $siswa->nama) }}" 
                        class="input-field" 
                        placeholder="Masukkan nama siswa"
                        required
                    >
                    @error('nama')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- NIS -->
                <div>
                    <label for="nis" class="input-label">🆔 Nomor Induk Siswa (NIS)</label>
                    <input 
                        type="text" 
                        name="nis" 
                        id="nis" 
                        value="{{ old('nis', $siswa->nis) }}" 
                        class="input-field" 
                        placeholder="Contoh: 2024001"
                        required
                    >
                    @error('nis')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelas -->
                <div>
                    <label for="kelas" class="input-label">📚 Kelas</label>
                    <input 
                        type="text" 
                        name="kelas" 
                        id="kelas" 
                        value="{{ old('kelas', $siswa->kelas) }}" 
                        class="input-field" 
                        placeholder="Contoh: XII-A"
                        required
                    >
                    @error('kelas')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jurusan -->
                <div>
                    <label for="jurusan" class="input-label">🎓 Jurusan</label>
                    <input 
                        type="text" 
                        name="jurusan" 
                        id="jurusan" 
                        value="{{ old('jurusan', $siswa->jurusan) }}" 
                        class="input-field" 
                        placeholder="Contoh: Teknologi Informasi"
                        required
                    >
                    @error('jurusan')
                        <p class="input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-6">
                    <a 
                        href="{{ route('siswas.index') }}" 
                        class="flex-1 btn-secondary text-center"
                    >
                        Batal
                    </a>
                    <button 
                        type="submit" 
                        class="flex-1 btn-primary"
                    >
                        ✓ Perbarui Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>