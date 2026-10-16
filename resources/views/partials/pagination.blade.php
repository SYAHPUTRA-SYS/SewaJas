@if ($data->total() > 0)
<div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
    <div class="text-muted small">
        @if(!empty($search))
            (hasil pencarian "<em>{{ $search }}</em>")
        @endif
    </div>
    <div>
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
</div>
@endif
