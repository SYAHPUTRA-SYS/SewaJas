<form method="GET" action="{{ url()->current() }}" class="d-flex gap-2">
    <input class="form-control form-control-sm table-search" type="search"
           name="search" value="{{ $search ?? '' }}"
           placeholder="{{ $placeholder ?? 'Cari...' }}"
           aria-label="Search">
    <button class="btn btn-outline-secondary btn-sm" type="submit">
        <i class="bi bi-search"></i>
    </button>
    @if(!empty($search))
        <a href="{{ url()->current() }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-x-circle"></i>
        </a>
    @endif
</form>
