<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Detail Buku</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">{{ $buku->judul }}</h1>
            </div>
            <a href="{{ route('bukus.index') }}" class="btn-secondary">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Book Detail Card -->
        <div class="glass-card overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Cover Image -->
                <div class="md:w-1/3 p-8 flex items-center justify-center bg-gradient-to-br from-violet-500/10 to-fuchsia-500/5">
                    @if($buku->gambar)
                        <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="w-48 h-64 object-cover rounded-2xl border border-white/10 shadow-[0_20px_60px_rgba(139,92,246,0.2)] transition-transform duration-300 hover:scale-105">
                    @else
                        <div class="w-48 h-64 rounded-2xl bg-gradient-to-br from-violet-500/20 to-fuchsia-500/20 border border-white/10 flex flex-col items-center justify-center gap-3">
                            <i class="fa-solid fa-book text-violet-400/50 text-5xl"></i>
                            <p class="text-xs text-slate-500">Tidak ada cover</p>
                        </div>
                    @endif
                </div>

                <!-- Book Info -->
                <div class="md:w-2/3 p-8 space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-2">{{ $buku->judul }}</h2>
                        <p class="text-slate-400">oleh <span class="text-violet-300 font-semibold">{{ $buku->penulis }}</span></p>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="glass-card p-4 text-center">
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Tahun Terbit</p>
                            <p class="text-lg font-bold text-white">{{ $buku->tahun_terbit }}</p>
                        </div>
                        <div class="glass-card p-4 text-center">
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Kategori</p>
                            <p class="text-lg font-bold text-violet-300">{{ $buku->kategori?->nama_kategori ?? 'N/A' }}</p>
                        </div>
                        <div class="glass-card p-4 text-center">
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Stok</p>
                            <p class="text-lg font-bold {{ $buku->stok > 0 ? 'text-emerald-400' : 'text-rose-400' }}">{{ $buku->stok }}</p>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('bukus.edit', $buku) }}" class="btn-edit px-6 py-2.5 text-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Edit Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi / Artikel -->
        @if($buku->deskripsi)
            <div class="glass-card p-8">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-align-left text-violet-400"></i>
                    Tentang Buku Ini
                </h3>
                <div class="text-slate-300 leading-relaxed whitespace-pre-line">{{ $buku->deskripsi }}</div>
            </div>
        @else
            <div class="glass-card p-8 text-center">
                <i class="fa-solid fa-file-lines text-slate-600 text-4xl mb-3"></i>
                <p class="text-slate-500">Belum ada deskripsi untuk buku ini.</p>
                <a href="{{ route('bukus.edit', $buku) }}" class="inline-block mt-3 text-sm text-violet-400 hover:text-violet-300 transition-colors">
                    + Tambahkan Deskripsi
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
