@extends('layouts.app')

@section('content')

<div class="page-heading">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-people" aria-hidden="true"></i></span>
      <div>
        <h1 class="h3 mb-1">{{ $title }}</h1>
      </div>
    </div>
</div>

<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-people" aria-hidden="true"></i>
                <span>Data Pelanggan</span>
            </h2>
        </div>

        {{-- Form Search Server-Side --}}
        @include('partials.search-form', [
            'search' => $search,
            'placeholder' => 'Cari Data Pelanggan...'
        ])
    </div>

    <a href="{{ route('createPelanggan') }}" class="btn btn-outline-primary btn-sm mb-2">
        <i class="bi bi-plus-circle"></i> Tambah
    </a>

    <div class="table-responsive">
        <table class="table align-middle mb-0" id="ordersTable">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggan as $item)
                <tr class="text-center">
                    {{-- Nomor urut sinkron dengan pagination --}}
                    <td>{{ $pelanggan->firstItem() + $loop->index }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        <button type="button" class="btn btn-outline-primary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $item->id }}">
                            <i class="bi bi-info-circle"></i>
                        </button>

                        @include('pelanggan/show')

                        <a href="{{ route('pelangganEdit', $item->id) }}"
                           class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{ route('pelangganDestroy', $item->id) }}"
                           class="btn btn-outline-danger btn-sm"
                           onclick="return confirm('Yakin hapus data ini?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                        @if(!empty($search))
                            Data dengan kata kunci "<strong>{{ $search }}</strong>" tidak ditemukan.
                        @else
                            Data pelanggan belum tersedia.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @include('partials.pagination', ['data' => $pelanggan, 'search' => $search])
</section>

@endsection
