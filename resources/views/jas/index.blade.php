@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
      <div>
        <h1 class="h3 mb-1">{{ $title }}</h1>
      </div>
    </div>
</div>
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-tags" aria-hidden="true"></i>
                <span>Kategori Jas</span>
            </h2>
        </div>
            {{-- Form Search Server-Side --}}
            @include('partials.search-form', [
                'search' => $search,
                'placeholder' => 'Cari Data Jas...'
            ])
        </div>
        <a href="{{ route('createJas') }}" class="btn btn-outline-primary btn-sm mb-2"><i class="bi bi-plus-circle"></i>Tambah</a>
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="ordersTable" data-searchable-table>
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Jas</th>
                        <th>Jenis Barang</th>
                        <th>Ukuran</th>
                        <th>Harga Sewa</th>
                        <th>Stok</th>
                        <th>Tersedia</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jas as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_jas }}</td>
                        <td>
                            @if ($item->jenis == 'toga')
                                <span class="badge bg-primary">Toga</span>
                            @elseif ($item->jenis == 'jas_almamater')
                                <span class="badge bg-success">Jas Almameter</span>
                            @elseif ($item->jenis == 'kebaya')
                                <span class="badge bg-danger">Kebaya</span>


                            @endif
                        </td>
                        <td>{{ $item->ukuran }}</td>
                        <td>Rp {{ number_format($item->harga_sewa_per_hari, 0, ',', '.') }}</td>
                        <td>
                            @if ($item->stok > 0)
                                <span class="badge bg-info">{{ $item->stok }}</span>
                            @else
                                <span class="badge bg-danger">Stok Habis</span>
                            @endif
                        </td>
                        <td class="text-black">
                            @if ($item->is_available && $item->stok > 0)
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle" aria-hidden="true"></i> Tersedia
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle" aria-hidden="true"></i> Tidak Tersedia
                                </span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                <i class="bi bi-info-circle"></i>
                            </button>
                            <a href="{{ route('editJas', $item->id) }}" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('destroyJas', $item->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('partials.pagination', ['data' => $jas, 'search' => $search])
    </div>
</section>
@include('jas/show')

@endsection
