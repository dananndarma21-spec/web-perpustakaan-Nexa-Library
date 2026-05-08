<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Kategori</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Kelola Kategori Buku</h1>
            </div>
            <a href="{{ route('kategoris.create') }}" class="btn-primary">+ Tambah Kategori</a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="glass-card p-5 flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div>
                <p class="text-sm text-slate-400">Tabel kategori modern dengan pencarian, aksi cepat, dan nuansa desain premium.</p>
            </div>
            <form method="GET" action="{{ route('kategoris.index') }}" class="flex w-full gap-3 max-w-2xl">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="search-input" />
                <button type="submit" class="btn-secondary">Cari</button>
            </form>
        </div>

        <div class="table-panel">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="table-cell">ID</th>
                            <th class="table-cell">Nama Kategori</th>
                            <th class="table-cell">Keterangan</th>
                            <th class="table-cell text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $kategori)
                            <tr class="table-row group" id="kategori-row-{{ $kategori->id }}">
                                <td class="table-cell font-mono text-xs text-slate-500">#{{ $kategori->id }}</td>
                                <td class="table-cell font-semibold text-white">{{ $kategori->nama_kategori }}</td>
                                <td class="table-cell">{{ $kategori->keterangan }}</td>
                                <td class="table-cell text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('kategoris.edit', $kategori) }}" class="btn-edit">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <button type="button" class="btn-delete" onclick="confirmDelete('{{ route('kategoris.destroy', $kategori) }}', 'kategori-row-{{ $kategori->id }}')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="table-cell text-center" colspan="4">Tidak ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-end">
            {{ $kategoris->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>