<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.32em] text-violet-300/70">Siswa</p>
                <h1 class="mt-3 text-3xl font-semibold text-white">Kelola Data Siswa</h1>
            </div>
            <a href="{{ route('siswas.create') }}" class="btn-primary">+ Tambah Siswa Baru</a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <div class="glass-card p-5 flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div>
                <p class="text-sm text-slate-400">Data siswa terstruktur dalam tabel modern dengan pencarian instan.</p>
            </div>
            <form method="GET" action="{{ route('siswas.index') }}" class="flex w-full gap-3 max-w-2xl">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari siswa, NIS, kelas..." class="search-input" />
                <button type="submit" class="btn-secondary">Cari</button>
            </form>
        </div>

        <div class="table-panel">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="table-cell">ID</th>
                            <th class="table-cell">Nama</th>
                            <th class="table-cell">NIS</th>
                            <th class="table-cell">Kelas</th>
                            <th class="table-cell">Jurusan</th>
                            <th class="table-cell text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $siswa)
                            <tr class="table-row group" id="siswa-row-{{ $siswa->id }}">
                                <td class="table-cell font-mono text-xs text-slate-500">#{{ $siswa->id }}</td>
                                <td class="table-cell font-semibold text-white">{{ $siswa->nama }}</td>
                                <td class="table-cell">{{ $siswa->nis }}</td>
                                <td class="table-cell">{{ $siswa->kelas }}</td>
                                <td class="table-cell">{{ $siswa->jurusan }}</td>
                                <td class="table-cell text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('siswas.edit', $siswa) }}" class="btn-edit">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <button type="button" class="btn-delete" onclick="confirmDelete('{{ route('siswas.destroy', $siswa) }}', 'siswa-row-{{ $siswa->id }}')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="table-cell text-center" colspan="6">Tidak ada data siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-end">
            {{ $siswas->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>