<form action="{{ $action }}" method="POST" class="d-inline"
    onsubmit="return confirm('{{ $message ?? 'Apakah Anda yakin ingin menghapus data ini?' }}')">
    @csrf
    @method('DELETE')
    <button class="btn btn-sm btn-danger" type="submit" title="Hapus">
        <i class="fas fa-trash"></i>
    </button>
</form>
