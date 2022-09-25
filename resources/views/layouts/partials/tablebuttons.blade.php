@if($edit)
@can($url.'-edit')
<a class="btn btn-primary" href="{{ route($url.'.edit',$id) }}">
    <i class="fas fa-pencil-alt">
    </i>

</a>
@endcan
@endif
@if($delete)
@can($url.'-delete')

<form action="{{ route($url.'.destroy', $id) }}" method="post" style="display:inline-block">
    @csrf
    @method("DELETE")
    <button type="submit" class="btn btn-danger">
        <i class="fas fa-trash"></i>
    </button>
</form>

@endcan
@endif

@if($restore)
@role("Admin")

<a class="btn btn-dark" href="{{ route($url.'.restore', $id) }}">
    <i class="fas fa-trash"></i>Restore
</a>

@endrole
@endif

@if($show)

<a class="btn btn-info" href="{{ route($url.'.show',$id) }}">
    <i class="fas fa-eye">
    </i>

</a>
@endif