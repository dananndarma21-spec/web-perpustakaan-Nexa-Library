<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('peminjamans.index') }}" class="text-slate-400 hover:text-white transition-colors duration-200">
                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
            </a>
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-violet-400/80">Edit Transaction</p>
                <h1 class="text-2xl font-extrabold text-white">Update Peminjaman</h1>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="glass-panel p-8">
            <form action="{{ route('peminjamans.update', $peminjaman) }}" method="POST" class="space-y-6" id="editForm">
                @csrf @method('PUT')

                {{-- ── Info Peminjam & Buku ── --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-white/5">
                    <div class="space-y-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Peminjam</p>
                        <p class="text-lg font-bold text-white">{{ $peminjaman->siswa->nama }}</p>
                        <p class="text-xs text-slate-400">NIS: {{ $peminjaman->siswa->nis }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Buku</p>
                        <p class="text-lg font-bold text-white">{{ $peminjaman->buku->judul }}</p>
                    </div>
                </div>

                {{-- ── Info Tanggal ── --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-white/5">
                    <div class="space-y-1">
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Pinjam</p>
                        <p class="text-sm text-slate-300 font-medium">
                            <i class="fa-regular fa-calendar mr-1 text-violet-400/60"></i>
                            {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                        </p>
                    </div>
                    @if($peminjaman->tanggal_pengembalian)
                        <div class="space-y-1">
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Dikembalikan</p>
                            <p class="text-sm text-emerald-400 font-semibold">
                                <i class="fa-solid fa-check-circle mr-1"></i>
                                {{ $peminjaman->tanggal_pengembalian->format('d M Y') }}
                            </p>
                        </div>
                    @endif
                </div>

                {{-- ── Status Badge ── --}}
                <div class="pb-6 border-b border-white/5">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Status Saat Ini</p>
                    @if($peminjaman->computed_status === 'terlambat')
                        <span class="badge-late" style="animation: pulse-badge 2s ease-in-out infinite;">
                            <i class="fa-solid fa-triangle-exclamation mr-1"></i> Terlambat {{ $previewDays }} hari
                        </span>
                    @elseif($peminjaman->computed_status === 'dipinjam')
                        <span class="badge-borrowed">
                            <i class="fa-solid fa-clock mr-1"></i> Dipinjam
                        </span>
                    @else
                        <span class="badge-returned">
                            <i class="fa-solid fa-check mr-1"></i> Dikembalikan
                        </span>
                    @endif
                </div>

                {{-- ── Denda Info ── --}}
                @if($peminjaman->computed_status === 'dikembalikan' && $peminjaman->computed_denda > 0)
                    <div class="rounded-2xl bg-rose-500/5 border border-rose-500/10 p-4">
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-rose-300">
                                <b>💰 Denda Tercatat</b>
                            </p>
                            <p class="text-lg font-bold text-rose-400">
                                Rp {{ number_format($peminjaman->computed_denda, 0, ',', '.') }}
                            </p>
                        </div>
                        @if($peminjaman->hari_terlambat > 0)
                            <p class="text-xs text-rose-400/50 mt-1">{{ $peminjaman->hari_terlambat }} hari × Rp 5.000</p>
                        @endif
                    </div>
                @endif

                @if($peminjaman->computed_status === 'terlambat' && $previewDenda > 0)
                    <div class="rounded-2xl bg-amber-500/5 border border-amber-500/10 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-amber-300">
                                    ⚠️ Terlambat {{ $previewDays }} hari
                                </p>
                                <p class="text-xs text-amber-300/60 mt-1">
                                    {{ $previewDays }} hari × Rp 5.000
                                </p>
                            </div>
                            <p class="text-lg font-bold text-rose-400">
                                Rp {{ number_format($previewDenda, 0, ',', '.') }}
                            </p>
                        </div>
                        <p class="text-[10px] text-amber-400/40 mt-2">
                            Denda ini akan disimpan saat status diubah ke "Dikembalikan"
                        </p>
                    </div>
                @elseif($peminjaman->computed_status === 'dipinjam')
                    <div class="rounded-2xl bg-emerald-500/5 border border-emerald-500/10 p-4">
                        <p class="text-sm text-emerald-300">
                            ✅ <b>Belum terlambat</b> — Tidak ada denda saat ini.
                        </p>
                    </div>
                @endif

                {{-- ── Form Fields ── --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="input-label">Status Peminjaman</label>
                        <select name="status" class="input-field select-field" required>
                            <option value="dipinjam" {{ old('status', $peminjaman->status) == 'dipinjam' ? 'selected' : '' }}>Masih Dipinjam</option>
                            <option value="dikembalikan" {{ old('status', $peminjaman->status) == 'dikembalikan' ? 'selected' : '' }}>Sudah Dikembalikan</option>
                        </select>
                        @error('status') <p class="input-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="input-label">Deadline (Batas Kembali)</label>
                        <input
                            type="date"
                            name="tanggal_kembali"
                            id="tanggal_kembali"
                            value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali ? $peminjaman->tanggal_kembali->format('Y-m-d') : '') }}"
                            min="{{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}"
                            class="input-field"
                            required
                        />
                        @error('tanggal_kembali') <p class="input-error">{{ $message }}</p> @enderror
                        <p class="text-xs text-slate-500">
                            Minimal: {{ $peminjaman->tanggal_pinjam->format('d M Y') }}
                        </p>
                        <p id="deadline-warning" class="text-xs text-rose-400 hidden">
                            ⚠️ Deadline tidak boleh sebelum tanggal pinjam!
                        </p>
                    </div>
                </div>

                {{-- ── Info Box ── --}}
                <div class="rounded-2xl bg-violet-500/5 border border-violet-500/10 p-4">
                    <p class="text-xs text-violet-300">
                        <b><i class="fa-solid fa-info-circle mr-1"></i> Info:</b>
                        Jika status diubah ke <b>Dikembalikan</b>, denda akan dihitung otomatis.
                        Denda hanya berlaku jika hari ini melewati deadline.
                        Tanggal pengembalian dicatat sebagai hari ini ({{ \Carbon\Carbon::today()->format('d M Y') }}).
                    </p>
                </div>

                <div class="pt-6 border-t border-white/5 flex items-center justify-end gap-4">
                    <a href="{{ route('peminjamans.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary px-10" id="btnSubmit">
                        <i class="fa-solid fa-save mr-2"></i> Update Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes pulse-badge {
            0%, 100% { box-shadow: 0 0 0 0 rgba(244, 63, 94, 0); }
            50% { box-shadow: 0 0 16px 2px rgba(244, 63, 94, 0.18); }
        }
    </style>

    <script>
        // Client-side deadline validation
        const deadlineInput = document.getElementById('tanggal_kembali');
        const deadlineWarning = document.getElementById('deadline-warning');
        const btnSubmit = document.getElementById('btnSubmit');
        const minDate = '{{ $peminjaman->tanggal_pinjam->format("Y-m-d") }}';

        deadlineInput.addEventListener('change', function() {
            if (this.value < minDate) {
                deadlineWarning.classList.remove('hidden');
                this.classList.add('border-rose-500');
                btnSubmit.disabled = true;
                btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                deadlineWarning.classList.add('hidden');
                this.classList.remove('border-rose-500');
                btnSubmit.disabled = false;
                btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });
    </script>
</x-app-layout>
