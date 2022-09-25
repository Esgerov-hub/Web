@extends('layouts.dashboard')
@section("title")
    Contacts
@endsection
@section('dashboard.css')

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
                    @can('contacts-view')
                    @include("layouts.partials.topbuttons",['url'=>"contacts","add"=>false,'home'=>false,'delete' => true,'type' => false])
                    @endcan
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                </div>
            </div>
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
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Settings</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contacts as $contact)
                                        @if($contact->users != null)
                                        <tr>
                                            <td>{{ $contact->id }}</td>
                                            <td>{{ $contact->namesurname }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning d-inline-block"
                                                        onClick="getShow({{$contact->id}});"><i class="fa fa-eye"></i>
                                                </button>
                                                @include("layouts.partials.tablebuttons",[
    "url"=>"contacts",
    "id"=>$contact->id,
    "edit"=>false,
    "delete"=>true,
    "show"=>false,
    "restore"=>false
])
                                            </td>
                                        </tr>
                                        @endif
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
                    <h5 class="modal-title" id="showModalLabel">Contacts</h5>
                    <button type="button" class="close ml-5" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="contactsShow">
                        @csrf
                        <input type="hidden" name="contacts_id" id="contacts_id" value="">
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Name</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="contacts_namesurname" id="contacts_namesurname">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Phone</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="contacts_phone" id="contacts_phone">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Email</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="contacts_email" id="contacts_email">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Subject</span>
                        <input type="text" value="" disabled class="form-control"
                               name="contacts_subject" id="contacts_subject">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Content</span>
                        <textarea type="text"   class="form-control" disabled
                                  name="contacts_content" id="contacts_content"></textarea>
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Ip Address </span>
                        <input type="text" value=""  class="form-control" disabled
                               name="contacts_ipaddress" id="contacts_ipaddress">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">User</span>
                        <input type="text" value="" disabled class="form-control"
                               name="contacts_user_id" id="contacts_user_id">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Created</span>
                        <input type="text" value=""  class="form-control" disabled
                               name="contacts_created_at" id="contacts_created_at">
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

            var url = '{{env('APP_URL ')}}/home/contacts/' + id;
            $.ajax({
                url: `${url}`,
                dataType: 'json',
                type: 'get',
                success: function (data) {
                    $("form#contactsShow input#contacts_id").val(data['id']);
                    $("form#contactsShow input#contacts_namesurname").val(data['namesurname']);
                    $("form#contactsShow input#contacts_phone").val(data['phone']);
                    $("form#contactsShow input#contacts_email").val(data['email']);
                    $("form#contactsShow input#contacts_subject").val(data['subject']);
                    $("form#contactsShow textarea#contacts_content").val(data['message']);
                    $("form#contactsShow input#contacts_ipaddress").val(data['ipaddress']);
                    $("form#contactsShow input#contacts_user_id").val(data['user_id']);
                    $("form#contactsShow input#contacts_created_at").val(data['created_at']);
                    $('#showModal').modal('toggle');
                },
                error: function (data) {
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
