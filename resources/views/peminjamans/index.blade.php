<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.3em] text-violet-400/80">Transaction Overview</p>
                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-white">Manajemen Peminjaman</h1>
            </div>
            <a href="{{ route('peminjamans.create') }}" class="btn-primary group">
                <span class="mr-2 inline-block transition-transform duration-200 group-hover:rotate-90">+</span> Catat Pinjaman Baru
            </a>
        </div>
    </x-slot>

    <div class="space-y-8">

        {{-- ════════════════════════════════════════════
             SUMMARY STATS
        ════════════════════════════════════════════ --}}
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5">
            {{-- Total --}}
            <div class="glass-panel group relative overflow-hidden transition-all duration-300 hover:scale-[1.03] hover:shadow-[0_20px_60px_rgba(139,92,246,0.08)]">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-slate-400">Total Transaksi</p>
                    <h3 class="mt-2 text-3xl font-bold text-white">{{ $stats['total'] }}</h3>
                </div>
                <div class="absolute -right-4 -top-4 text-8xl font-black text-white/[0.03]">TX</div>
            </div>

            {{-- Dipinjam --}}
            <div class="glass-panel group relative overflow-hidden transition-all duration-300 hover:scale-[1.03]">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-amber-400/80">Sedang Dipinjam</p>
                    <h3 class="mt-2 text-3xl font-bold text-white">{{ $stats['dipinjam'] }}</h3>
                </div>
                <div class="absolute -right-4 -top-4 text-8xl font-black text-amber-500/[0.03]">LO</div>
            </div>

            {{-- Dikembalikan --}}
            <div class="glass-panel group relative overflow-hidden transition-all duration-300 hover:scale-[1.03]">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-emerald-400/80">Dikembalikan</p>
                    <h3 class="mt-2 text-3xl font-bold text-white">{{ $stats['dikembalikan'] }}</h3>
                </div>
                <div class="absolute -right-4 -top-4 text-8xl font-black text-emerald-500/[0.03]">OK</div>
            </div>

            {{-- Terlambat --}}
            <div class="glass-panel group relative overflow-hidden transition-all duration-300 hover:scale-[1.03]">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-rose-400/80">Terlambat</p>
                    <h3 class="mt-2 text-3xl font-bold text-white {{ $stats['terlambat'] > 0 ? 'text-rose-400' : '' }}">{{ $stats['terlambat'] }}</h3>
                </div>
                <div class="absolute -right-4 -top-4 text-8xl font-black text-rose-500/[0.03]">!!</div>
            </div>

            {{-- Total Denda --}}
            <div class="glass-panel group relative overflow-hidden transition-all duration-300 hover:scale-[1.03]">
                <div class="relative z-10">
                    <p class="text-sm font-medium text-fuchsia-400/80">Total Denda</p>
                    <h3 class="mt-2 text-2xl font-bold text-white {{ $stats['total_denda'] > 0 ? 'text-fuchsia-300' : '' }}">
                        Rp {{ number_format($stats['total_denda'], 0, ',', '.') }}
                    </h3>
                </div>
                <div class="absolute -right-4 -top-4 text-8xl font-black text-fuchsia-500/[0.03]">$$</div>
            </div>
        </div>

        {{-- ════════════════════════════════════════════
             TABLE
        ════════════════════════════════════════════ --}}
        <div class="space-y-4">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between px-1">
                <h4 class="text-lg font-semibold text-slate-200">
                    <i class="fa-solid fa-list-check mr-2 text-violet-400/60"></i>Daftar Peminjaman
                </h4>
                <form action="{{ route('peminjamans.index') }}" method="GET" class="relative max-w-sm">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari siswa atau buku..."
                        class="search-input w-64 pl-10 pr-4 lg:w-80" />
                </form>
            </div>

            <div class="table-panel">
                <div class="overflow-x-auto">
                    <table class="w-full text-left" id="peminjaman-table">
                        <thead class="table-header">
                            <tr>
                                <th class="table-cell">ID</th>
                                <th class="table-cell">Peminjam</th>
                                <th class="table-cell">Buku</th>
                                <th class="table-cell">Tgl Pinjam</th>
                                <th class="table-cell">Deadline</th>
                                <th class="table-cell">Tgl Kembali</th>
                                <th class="table-cell">Status</th>
                                <th class="table-cell">Denda</th>
                                <th class="table-cell text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/[0.04]">
                            @forelse($peminjamans as $p)
                                <tr class="table-row group {{ $p->computed_status === 'terlambat' ? 'table-row-late' : '' }}"
                                    id="peminjaman-row-{{ $p->id }}">

                                    {{-- ID --}}
                                    <td class="table-cell font-mono text-xs text-slate-500">#{{ $p->id }}</td>

                                    {{-- Peminjam --}}
                                    <td class="table-cell">
                                        <div class="font-semibold text-white">{{ $p->siswa->nama }}</div>
                                        <div class="text-xs text-slate-400">{{ $p->siswa->nis }}</div>
                                    </td>

                                    {{-- Buku --}}
                                    <td class="table-cell">
                                        <div class="font-medium text-slate-200">{{ $p->buku->judul }}</div>
                                    </td>

                                    {{-- Tgl Pinjam --}}
                                    <td class="table-cell">
                                        <span class="text-xs text-slate-400">{{ $p->tanggal_pinjam->format('d M Y') }}</span>
                                    </td>

                                    {{-- Deadline --}}
                                    <td class="table-cell">
                                        @if($p->tanggal_kembali)
                                            <span class="text-xs {{ $p->computed_status === 'terlambat' ? 'text-rose-400 font-bold' : 'text-slate-400' }}">
                                                {{ $p->tanggal_kembali->format('d M Y') }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-600">—</span>
                                        @endif
                                    </td>

                                    {{-- Tgl Kembali (Pengembalian aktual) --}}
                                    <td class="table-cell">
                                        @if($p->tanggal_pengembalian)
                                            <span class="text-xs text-emerald-400 font-medium">
                                                {{ $p->tanggal_pengembalian->format('d M Y') }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-600">—</span>
                                        @endif
                                    </td>

                                    {{-- Status Badge --}}
                                    <td class="table-cell">
                                        @if($p->computed_status === 'terlambat')
                                            <span class="badge-late" style="animation: pulse-badge 2s ease-in-out infinite;">
                                                <i class="fa-solid fa-triangle-exclamation mr-1"></i> Terlambat
                                            </span>
                                        @elseif($p->computed_status === 'dipinjam')
                                            <span class="badge-borrowed">
                                                <i class="fa-solid fa-clock mr-1"></i> Dipinjam
                                            </span>
                                        @else
                                            <span class="badge-returned">
                                                <i class="fa-solid fa-check mr-1"></i> Kembali
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Denda --}}
                                    <td class="table-cell">
                                        <div class="font-bold {{ $p->computed_denda > 0 ? 'text-rose-400' : 'text-slate-500' }}">
                                            Rp {{ number_format($p->computed_denda, 0, ',', '.') }}
                                        </div>
                                        @if($p->computed_status === 'terlambat' && $p->hari_terlambat > 0)
                                            <div class="text-[10px] text-rose-400/70 mt-0.5">
                                                <i class="fa-regular fa-clock mr-0.5"></i>{{ $p->hari_terlambat }} hari × Rp 5.000
                                            </div>
                                        @elseif($p->computed_status === 'dikembalikan' && $p->computed_denda > 0)
                                            <button type="button"
                                                onclick="bayarDenda('{{ $p->id }}', '{{ route('peminjamans.bayar-denda', $p) }}')"
                                                class="mt-1 inline-flex items-center gap-1 rounded-lg border border-emerald-500/20 bg-emerald-500/10 px-2.5 py-1 text-[10px] font-bold text-emerald-400 transition hover:bg-emerald-500/20 hover:text-emerald-300 cursor-pointer">
                                                <i class="fa-solid fa-money-bill-wave"></i> Bayar & Lunas
                                            </button>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="table-cell text-right">
                                        <div class="flex justify-end gap-2 opacity-70 group-hover:opacity-100 transition-opacity duration-200">
                                            <a href="{{ route('peminjamans.edit', $p) }}" class="btn-edit">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit
                                            </a>
                                            <button type="button" class="btn-delete"
                                                onclick="confirmDelete('{{ route('peminjamans.destroy', $p) }}', 'peminjaman-row-{{ $p->id }}')">
                                                <i class="fa-solid fa-trash-can"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-16 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <div class="text-4xl text-slate-700"><i class="fa-solid fa-inbox"></i></div>
                                            <p class="text-slate-500 text-sm">Belum ada data transaksi peminjaman.</p>
                                            <a href="{{ route('peminjamans.create') }}" class="text-violet-400 text-xs hover:text-violet-300 transition-colors">
                                                + Catat peminjaman pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $peminjamans->appends(request()->query())->links() }}
            </div>
        </div>

        {{-- ════════════════════════════════════════════
             LEGEND
        ════════════════════════════════════════════ --}}
        <div class="glass-card p-5 mt-2">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Keterangan Status & Denda</p>
            <div class="flex flex-wrap gap-x-6 gap-y-2">
                <div class="flex items-center gap-2">
                    <span class="badge-borrowed text-[10px]">Dipinjam</span>
                    <span class="text-xs text-slate-500">Masih dalam masa pinjam, belum lewat deadline</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="badge-late text-[10px]">Terlambat</span>
                    <span class="text-xs text-slate-500">Sudah lewat deadline → denda Rp 5.000/hari</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="badge-returned text-[10px]">Kembali</span>
                    <span class="text-xs text-slate-500">Sudah dikembalikan</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes pulse-badge {
            0%, 100% { box-shadow: 0 0 0 0 rgba(244, 63, 94, 0); }
            50% { box-shadow: 0 0 16px 2px rgba(244, 63, 94, 0.18); }
        }
    </style>

    <script>
        function bayarDenda(id, url) {
            Swal.fire({
                title: 'Konfirmasi Pembayaran',
                text: 'Tandai denda sebagai LUNAS? Denda akan di-reset ke Rp 0.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#64748b',
                confirmButtonText: '✓ Ya, Sudah Lunas',
                cancelButtonText: 'Batal',
                background: '#0f172a',
                color: '#e2e8f0',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Lunas!',
                                text: data.message,
                                icon: 'success',
                                background: '#0f172a',
                                color: '#e2e8f0',
                                confirmButtonColor: '#8b5cf6',
                            }).then(() => location.reload());
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            title: 'Error',
                            text: 'Gagal memproses pembayaran.',
                            icon: 'error',
                            background: '#0f172a',
                            color: '#e2e8f0',
                        });
                    });
                }
            });
        }
    </script>
</x-app-layout>

