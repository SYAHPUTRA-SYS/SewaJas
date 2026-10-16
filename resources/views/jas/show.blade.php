@foreach ($jas as $item)
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}"><i class="bi bi-info-circle-fill"></i> Detail Kategori Jas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-6">
                Kode
            </div>
            <div class="col-6">
               : {{ $item->kode_jas }}
            </div>
            <div class="col-6">
                Jenis Barang
            </div>
            <div class="col-6">
                :
                @if ($item->jenis == 'toga')
                    <span class="badge bg-primary">Toga</span>
                @elseif ($item->jenis == 'jas_almamater')
                    <span class="badge bg-success">Jas Almamater</span>
                @elseif ($item->jenis == 'kebaya')
                    <span class="badge bg-danger">Kebaya</span>
                @endif
            </div>
            <div class="col-6">
                Ukuran
            </div>
            <div class="col-6">
               : {{ $item->ukuran }}
            </div>
            <div class="col-6">
                Stok Barang
            </div>
            <div class="col-6 mb-1">
               :
            @if ($item->stok > 0)
                <span class="badge bg-success">{{ $item->stok }}</span>
            @else
                <span class="badge bg-danger">Stok Habis</span>
            @endif
            </div>
            <div class="col-6">
                Harga Sewa Per-Hari
            </div>
            <div class="col-6">
               :
               <span class="badge bg-success">Rp {{ $item->harga_sewa_per_hari }}</span>
            </div>
            {{-- <div class="col-6">
                Denda Terlambat
            </div>
            <div class="col-6">
               : {{ $item->denda_terlambat }}
            </div> --}}
            <div class="col-6">
                Keterangan
            </div>
            <div class="col-6">
               <p>: {{ $item->keterangan }}</p>
            </div>
            <div class="col-6">
                Ketersediaan
            </div>
            <div class="col-6">
                :
                @if ($item->is_available && $item->stok > 0)
                 <span class="badge bg-success">Tersedia</span>

                 @else
                    <span class="badge bg-danger">Tidak Tersedia</span>
                @endif

            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i>
                Close
        </button>
      </div>
    </div>
  </div>
</div>
@endforeach
