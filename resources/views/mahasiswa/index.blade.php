@extends('layouts.app')

@section('content')
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">+ Tambah Mahasiswa</a>
    @endif

    <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Masukan Nim" value="{{ $search }}">
        <button type="submit" class="btn btn-outline-primary">Search</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;  
        }

        tr:nth-child(even) {
            background-color: rgba(74, 189, 101, 0.76);
        }

        th:nth-child(even),td:nth-child(even) {
            background-color: rgba(74, 189, 101, 0.76);
        }
    </style>
    
    <table class="border-collapse border border-gray-400 w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Nama</th>
                <th class="border p-2">NIM</th>
                <th class="border p-2">Jurusan</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Alamat</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $mhs)
                <tr>
                    <td class="border p-2">{{ $mhs->id }}</td>
                    <td class="border p-2">{{ $mhs->nama }}</td>
                    <td class="border p-2">{{ $mhs->nim }}</td>
                    <td class="border p-2">{{ $mhs->jurusan }}</td>
                    <td class="border p-2">{{ $mhs->email }}</td>
                    <td class="border p-2">{{ $mhs->alamat }}</td>
                    <td class="border p-2">
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin?')"> 🗑️ Hapus</button>
                            </form>
                        @else
                            <span class="text-muted">Hanya Dapat Melihat data</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

{{-- Link pagination --}}
{{ $data->links() }}