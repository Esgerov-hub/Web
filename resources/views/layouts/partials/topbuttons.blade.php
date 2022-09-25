<div class="col-sm-6">
    @if($add)
        <a href="{{ route($url.'.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-save"></i>
            New Create
        </a>

    @endif

        @if($home)
            @can($url.'-view')
                <a href="{{ route($url.'.index') }}?type=1" class="btn btn-success btn-sm">
                    <i class="fa fa-list"></i>
                    List
                </a>
            @endcan
        @endif


        @if($delete)
        @role('Admin')
            <a href="{{ route($url.'.recycle',$type) }}" class="btn btn-warning btn-sm">
                <i class="fa fa-trash"></i>
                Deleted
            </a>
        @endrole
        @endif
</div>
