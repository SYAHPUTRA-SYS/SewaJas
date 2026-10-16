@foreach ($pelanggan as $item)
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="detailModalLabel{{ $item->id }}"><i class="bi bi-info-circle-fill"></i> Detail Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="fw-bold text-muted small">Nama</label>
                    <p class="mb-0">{{ $item->nama }}</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted small">NIM</label>
                    <p class="mb-0">{{ $item->nim }}</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted small">Jenis Kelamin</label>
                    <p class="mb-0">
                        @if($item->jenis_kelamin == 'L')
                            <span class="badge bg-primary">👨 Laki-laki</span>
                        @else
                            <span class="badge bg-danger">👩 Perempuan</span>
                        @endif
                    </p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted small">Email</label>
                    <p class="mb-0">{{ $item->email }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="fw-bold text-muted small">No HP</label>
                    <p class="mb-0">{{ $item->no_hp }}</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted small">Jurusan</label>
                    <p class="mb-0">{{ $item->jurusan }}</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted small">Alamat</label>
                    <p class="mb-0">{{ $item->alamat }}</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold text-muted small">Tanggal Dibuat</label>
                    <p class="mb-0">{{ $item->created_at->format('d-m-Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i>
            Close
        </button>
      </div>
    </div>
  </div>
</div>
@endforeach
