@extends('layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
      <span class="page-icon"><i class="bi bi-cart" aria-hidden="true"></i></span>
      <div>
        <h1 class="h3 mb-1">{{ $title }}</h1>
      </div>
    </div>
</div>
<section class="panel">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-cart" aria-hidden="true"></i>
                <span>Data Pesanan</span>
            </h2>
        </div>
            {{-- Form Search Server-Side --}}
            @include('partials.search-form', [
                'search' => $search,
                'placeholder' => 'Cari Data Jas...'
            ])
        </div>
        <a href="{{ route('pesanCreate') }}" class="btn btn-outline-primary btn-sm mb-2">
            <i class="bi bi-plus-circle"></i>
            Tambah Pesanan
        </a>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="pemesananTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Jas</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemesanans as $index => $item)
                    <tr>
                        <td>{{ $index + $pemesanans->firstItem() }}</td>
                        <td>
                            <strong>{{ $item->pelanggan->nama ?? '-' }}</strong>
                            <br>
                            <small class="text-muted">{{ $item->pelanggan->nim ?? '-' }}</small>
                        </td>
                        <td>
                            {{ $item->jas->jenis_label ?? '-' }}
                            <br>
                            <small class="text-muted">{{ $item->jas->kode_jas ?? '-' }}</small>
                        </td>
                        <td>{{ $item->tanggal_sewa ? date('d/m/Y', strtotime($item->tanggal_sewa)) : '-' }}</td>
                        <td>{{ $item->tanggal_kembali ? date('d/m/Y', strtotime($item->tanggal_kembali)) : '-' }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td>{!! $item->status_label !!}</td>
                        <td>{!! $item->pembayaran_label !!}</td>
                        <td>
                            <a href="{{ route('pemesanan.invoice', $item->id) }}"
                                class="btn btn-outline-primary btn-sm mb-1" title="Invoice" target="_blank">
                                    <i class="bi bi-receipt"></i>
                            </a>
                            <a href="{{ route('pesananShow', $item->id) }}"
                                   class="btn btn-outline-info btn-sm mb-1" title="Detail">
                                    <i class="bi bi-info-circle"></i>
                            </a>
                            <a href="{{ route('pesananEdit', $item->id) }}"
                                   class="btn btn-outline-warning btn-sm mb-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('pesananDestroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            <br>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">
                            <i class="fas fa-shopping-cart fa-3x text-muted mb-3 d-block"></i>
                            <h5>Belum ada data pemesanan</h5>
                            <p class="text-muted">Silakan tambahkan pemesanan baru</p>
                            <a href="{{ route('pesanCreate') }}" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i> Tambah Pemesanan
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('partials.pagination', ['data' => $pemesanans, 'search' => $search])

        {{-- <div class="d-flex justify-content-end mt-3">
            {{ $pemesanans->links() }} --}}
        </div>
    </div>
    </div>
</section>

@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $('#pemesananTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
            },
            "paging": false,
            "info": false,
            "searching": true,
            "ordering": true,
            "columnDefs": [
                { "orderable": false, "targets": [0, 9] }
            ]
        });
    });
</script>
@endpush
