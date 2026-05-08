<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Buku</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Kelola Koleksi Buku</h1>
            </div>
            <a href="{{ route('bukus.create') }}" class="btn-primary">+ Tambah Buku Baru</a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="glass-card p-5 flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div>
                <p class="text-sm text-slate-400">Lihat detail buku, kategori, stok, dan tindakan langsung dalam tabel premium.</p>
            </div>
            <form method="GET" action="{{ route('bukus.index') }}" class="flex w-full gap-3 max-w-2xl">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, penulis, kategori..." class="search-input" />
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
                        @forelse($bukus as $buku)
                            <tr class="table-row group" id="buku-row-{{ $buku->id }}">
                                <td class="table-cell">
                                    @if($buku->gambar)
                                        <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="w-12 h-16 object-cover rounded-lg border border-white/10 shadow-lg">
                                    @else
                                        <div class="w-12 h-16 rounded-lg bg-gradient-to-br from-violet-500/20 to-fuchsia-500/20 border border-white/10 flex items-center justify-center">
                                            <i class="fa-solid fa-book text-violet-400/60 text-lg"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="table-cell">
                                    <a href="{{ route('bukus.show', $buku) }}" class="font-semibold text-white hover:text-violet-300 transition-colors">
                                        {{ $buku->judul }}
                                    </a>
                                </td>
                                <td class="table-cell">{{ $buku->penulis }}</td>
                                <td class="table-cell">{{ $buku->tahun_terbit }}</td>
                                <td class="table-cell">{{ $buku->kategori?->nama_kategori ?? 'N/A' }}</td>
                                <td class="table-cell">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold {{ $buku->stok > 0 ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border border-rose-500/20' }}">
                                        {{ $buku->stok }}
                                    </span>
                                </td>
                                <td class="table-cell text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('bukus.show', $buku) }}" class="btn-detail">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('bukus.edit', $buku) }}" class="btn-edit">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <button type="button" class="btn-delete" onclick="confirmDelete('{{ route('bukus.destroy', $buku) }}', 'buku-row-{{ $buku->id }}')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="table-cell text-center" colspan="7">Tidak ada buku tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-end">
            {{ $bukus->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>