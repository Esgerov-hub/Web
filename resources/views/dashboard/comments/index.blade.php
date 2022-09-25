@extends('layouts.dashboard')
@section("title")
    Comments
@endsection
@section('dashboard.css')
    <meta name="_token" content="{{csrf_token()}}">

    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection
@section('dashboard.content')

    <div class="content-wrapper">
    <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    @can('comments-view')
                    @include("layouts.partials.topbuttons",['url'=>"comments","add"=>false,'home'=>false,'delete' => true,'type' => false])
                    @endcan
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    @if (Session::get('error'))
                    <div class="col-12 mt-1">
                        <div class="alert alert-danger" role="alert">
                            <div class="alert-body">{{ Session::get('error') }}</div>
                        </div>
                    </div>
                @endif
                @if (Session::get('success'))
                    <div class="col-12 mt-1">
                        <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <div class="alert-body">{{ Session::get('success') }}</div>
                        </div>
                    </div>
                @endif
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Uid</th>
                                        <th>Subject</th>
                                        <th>Content</th>
                                        <th>Status</th>
                                        <th>Settings</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{ $comment->id }}</td>
                                            <td>{{ $comment->uid }}</td>

                                            <td>{{ $comment->subject }}</td>
                                            <td>{{ $comment->content }}</td>
                                            <td>
                                                <label class="switch">

                                                    <input type="checkbox" name="attribute_status" @if($comment->status ==1) checked @endif id="attribute_status" onChange="changeStat({{$comment->id}},{{$comment->status}})">

                                                    <span class="slider round"></span>
                                                </label></td>
                                            <td>
                                                <button type="button" class="btn btn-warning d-inline-block"
                                                        onClick="getShow({{$comment->id}});"><i class="fa fa-eye"></i>
                                                </button>
                                                @include("layouts.partials.tablebuttons",[
    "url"=>"comments",
    "id"=>$comment->id,
    "edit"=>false,
    "delete"=>true,
    "show"=>false,
    "restore"=>false
])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    {{-- Show Modal --}}
    <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showModalLabel">Comment</h5>
                    <button type="button" class="close ml-5" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="attributeShow">
                        @csrf
                        <input type="hidden" name="attribute_id" id="attribute_id" value="">
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Uid</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="attribute_uid" id="attribute_uid">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Tip</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="attribute_type" id="attribute_type">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Subject</span>
                        <input type="text" value="" disabled class="form-control"
                               name="attribute_subject" id="attribute_subject">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Content</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="attribute_content" id="attribute_content">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Top</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="attribute_top_id" id="attribute_top_id">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">User</span>
                        <input type="text" value="" disabled class="form-control"
                               name="attribute_user_id" id="attribute_user_id">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Admin</span>
                        <input type="text" value="" disabled class="form-control"
                               name="attribute_admin_id" id="attribute_admin_id">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Element</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="attribute_element_id" id="attribute_element_id">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Global</span>
                        <input type="text" value="" class="form-control" disabled
                               name="attribute_global" id="attribute_global">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Rating</span>
                        <input type="text" value="" disabled class="form-control"
                               name="attribute_rating" id="attribute_rating">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Created</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="attribute_created_at" id="attribute_created_at">
                        <br>
                        <div class="align-right justify-content-end text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Show Modal --}}
@endsection
@section('dashboard.js')

    <script>
        function getShow(id) {

            var url = '{{env('APP_URL ')}}/home/comments/' + id;
            $.ajax({
                url: `${url}`,
                dataType: 'json',
                type: 'get',
                success: function (data) {
                    $("form#attributeShow input#attribute_id").val(data['id']);
                    $("form#attributeShow input#attribute_uid").val(data['uid']);
                    $("form#attributeShow input#attribute_type").val(data['type']);
                    $("form#attributeShow input#attribute_subject").val(data['subject']);
                    $("form#attributeShow input#attribute_content").val(data['content']);
                    $("form#attributeShow input#attribute_top_id").val(data['top_id']);
                    $("form#attributeShow input#attribute_user_id").val(data['user_id']);
                    $("form#attributeShow input#attribute_admin_id").val(data['admin_id']);
                    $("form#attributeShow input#attribute_element_id").val(data['element_id']);
                    $("form#attributeShow input#attribute_global").val(data['global']);
                    $("form#attributeShow input#attribute_rating").val(data['rating']);
                    $("form#attributeShow input#attribute_created_at").val(data['created_at']);
                    $('#showModal').modal('toggle');
                },
                error: function (data) {
                    toastr.error("Yenidən cəhd göstərin");
                }
            })
        }
    </script>
    <script>
        function changeStat(id,status){
            var  token = $("meta[name='_token']").attr('content');

            var url='{{env('APP_URL ')}}/home/comments_change_stat/'+id;
            $.ajax({
                url: `${url}`,
                dataType: 'json',
                data:{
                    status:status,
                    _token:token
                },
                type: 'patch',
                success: function(data) {
                    toastr.success("Məlumat yeniləndi");
                },
                error: function(data) {
                    toastr.error("Yenidən cəhd göstərin");
                }
            })
        }
    </script>

    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
