<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('peminjamans.index') }}" class="text-slate-400 hover:text-white transition-colors">← Kembali</a>
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-violet-400/80">New Transaction</p>
                <h1 class="text-2xl font-extrabold text-white">Catat Peminjaman</h1>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="glass-panel p-8">
            <form action="{{ route('peminjamans.store') }}" method="POST" class="space-y-6" id="formPeminjaman">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="input-label">Siswa Peminjam</label>
                        <select name="siswa_id" class="input-field select-field" required>
                            <option value="">Pilih Siswa</option>
                            @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama }} ({{ $siswa->nis }})
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_id') <p class="input-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="input-label">Buku yang Dipinjam</label>
                        <select name="buku_id" class="input-field select-field" required>
                            <option value="">Pilih Buku</option>
                            @foreach($bukus as $buku)
                                <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                    {{ $buku->judul }} (Stok: {{ $buku->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id') <p class="input-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="input-label">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" class="input-field" required />
                        @error('tanggal_pinjam') <p class="input-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="input-label">Tanggal Kembali (Deadline)</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}" class="input-field" required />
                        @error('tanggal_kembali') <p class="input-error">{{ $message }}</p> @enderror
                        <p id="date-warning" class="text-xs text-rose-400 hidden">
                            ⚠️ Tanggal kembali tidak boleh lebih awal dari tanggal pinjam!
                        </p>
                    </div>
                </div>

                <div class="pt-6 border-t border-white/5 flex items-center justify-between">
                    <p class="text-xs text-slate-500 max-w-xs">
                        * Peminjaman default berstatus <b>Dipinjam</b>. Stok buku akan berkurang otomatis.
                    </p>
                    <button type="submit" class="btn-primary px-10" id="btnSubmit">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Client-side validation: tanggal_kembali >= tanggal_pinjam
        const pinjamInput  = document.getElementById('tanggal_pinjam');
        const kembaliInput = document.getElementById('tanggal_kembali');
        const warning      = document.getElementById('date-warning');
        const btnSubmit    = document.getElementById('btnSubmit');

        function validateDates() {
            const pinjam  = pinjamInput.value;
            const kembali = kembaliInput.value;

            if (pinjam && kembali && kembali < pinjam) {
                warning.classList.remove('hidden');
                kembaliInput.classList.add('border-rose-500');
                kembaliInput.classList.remove('border-white/10');
                btnSubmit.disabled = true;
                btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                warning.classList.add('hidden');
                kembaliInput.classList.remove('border-rose-500');
                kembaliInput.classList.add('border-white/10');
                btnSubmit.disabled = false;
                btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
            }

            // Auto-set min date for kembali
            if (pinjam) {
                kembaliInput.min = pinjam;
            }
        }

        pinjamInput.addEventListener('change', function() {
            validateDates();
            // Jika kembali kosong atau < pinjam, auto-set +7 hari
            if (!kembaliInput.value || kembaliInput.value < this.value) {
                const d = new Date(this.value);
                d.setDate(d.getDate() + 7);
                kembaliInput.value = d.toISOString().split('T')[0];
            }
            validateDates();
        });

        kembaliInput.addEventListener('change', validateDates);

        // Run on page load
        validateDates();
    </script>
</x-app-layout>