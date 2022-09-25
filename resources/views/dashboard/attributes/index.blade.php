@extends('layouts.dashboard')
@section("title")
    Attributs
@endsection
@section('dashboard.css')

    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection
@section('dashboard.content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-2">
                        @can('attributes-create')
                            @include("dashboard.attributes.create")
                 
                        @endcan
                    </div>
                    <div class="col-sm-6">
                        @can('attributes-create')
                          
                            @include("layouts.partials.topbuttons",['url'=>"attributes","add"=>false,'home'=>false,'delete' => true,'type' => false])

                        @endcan
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Ad</th>
                                            <th>Tip</th>
                                            <th>Aid olduğu qrup</th>
                                            <th>Filter</th>
                                            <th>Düymələr</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $dat)
                                            <tr>
                                                <td>{{ $dat->name['az_name'] }}</td>
                                                
                                                <td 
                                                    @if ($dat->type==0)
                                                        class="text-danger"
                                                    @else
                                                        class="text-success"
                                                    @endif
                                                class=""
                                                >{{ $dat->type == 0 ?  "Atribut" : "Atribut Qrup" }}</td>
                                                <td>
                                                    @if ($dat->group_id !=null || $dat->group_id !==null)
                                                        {{$dat->group->name['az_name']}}
                                                    @else
                                                      <span class="text-small text-danger">  Qrupa aid deil</span>
                                                    @endif
                                                </td>
                                               
                                                <td>
                                                    <label class="switch">
                                                        
                                                        <input type="checkbox" name="attribute_filter" @if($dat->status ==1) checked @endif id="attribute_filter" onChange="changeStat({{$dat->id}},{{$dat->status}})">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                               
                                                <td>
                                                    <button type="button" class="btn btn-warning d-inline-block" onClick="getEdit({{$dat->id}});"><i class="fa fa-edit"></i></button>
                                                    
                                                @include("layouts.partials.tablebuttons",[
"url"=>"attributes",
"id"=>$dat->id,
"type"=>$dat->type,
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
                                <!-- ********************************************** -->
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

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Atribut məlumatlarını yenilə</h5>
                    <button type="button" class="close ml-5" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="attributeUpdate">
                        @csrf
                        <input type="hidden" name="attribute_id" id="attribute_id" value="">
                        <input type="text" value="" placeholder="Adı daxil edin..." class="form-control"
                               name="attribute_az_name" id="attribute_az_name">
                        <br>
                        <input type="text" value="" placeholder="Введите имя ..." class="form-control"
                               name="attribute_ru_name" id="attribute_ru_name">
                        <br>
                        <input type="text" value="" placeholder="Enter the name ..." class="form-control"
                               name="attribute_en_name" id="attribute_en_name">
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Tip</span>
                        <select class="form-control"
                                name="attribute_group" id="attribute_group">
                            <option value="0">Atribut</option>
                            <option value="1">Atribut Qrupu</option>
                        </select>
                        <br>
                        <div id="getGrrId" class="d-none">
                            <span style="font-size: 14px; margin-bottom:5px;display:block;">Atributun aid olduğu qrup</span>
                            <select name="group_id" class="form-control" id="group_id">
                                <option value="">Qrup seç</option>
                                @foreach ($groups as $group)
                                    <option value="{{$group->id}}">{{$group->name['az_name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <span style="font-size: 14px; margin-bottom:5px;display:block;">Məlumat tipi</span>
                        <select class="form-control"
                                name="datatype" id="datatype">
                            <option value="string">Yazı</option>
                            <option value="mm">Millimetr (mm)</option>
                            <option value="sm">Santimetr (sm)</option>
                            <option value="dm">Destemetr (dm)</option>
                            <option value="m">Metr (m)</option>
                            <option value="qr">Çəki (qr)</option>
                            <option value="kq">Çəki (kq)</option>
                            <option value="qyt">Ədəd (qyt)</option>
                        </select>
                        <br>
                        <span>Order</span>
                        <input type="text"   class="form-control"
                               name="attribute_order" id="attribute_order">
                        <br>
                        <span>Filter status</span>
                        <label class="switch">
                            <input type="checkbox" name="attribute_filter" id="attribute_filter">
                            <span class="slider round"></span>
                        </label>
                        <br>
                        <div class="align-right justify-content-end text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
                            <button type="button" onclick="attributeUpdate()" class="btn btn-primary">Yadda saxla</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Edit Modal --}}
@endsection
@section('dashboard.js')
    <script>
        // Attach a submit handler to the form
        function attributeStore() {
            // Stop form from submitting normally
            event.preventDefault();
            // Get some values from elements on the page:
            var
                az_name = $("form#attributeStore input#attribute_az_name").val(),
                ru_name = $("form#attributeStore input#attribute_ru_name").val(),
                en_name = $("form#attributeStore input#attribute_en_name").val();
                type = $("form#attributeStore select#attribute_group").val(),
                group_id = $("form#attributeStore select#group_id").val(),
                datatype = $("form#attributeStore select#datatype").val(),
                filter = $("form#attributeStore input#attribute_filter").val() =="on" ? 1 : 0,
                order = $("form#attributeStore input#attribute_order").val();
                console.log(group_id);

            var name = {};
            name['az_name'] = az_name;
            name['ru_name'] = ru_name;
            name['en_name'] = en_name;
            token = $("input[name='_token']").val();
            var posting = $.ajax({
                url: '{{ route('attributes.store') }}',
                dataType: 'json',
                data: {
                    name: name,
                    type:type,
                    group_id:group_id,
                    datatype:datatype,
                    order:order,
                    filter:filter,
                    _token: token
                },
                type: 'post',
                success: function(data) {
                    if (data == 1) {
                        toastr.success("Məlumat yükləndi");
                        $('#exampleModal').modal('toggle');
                        window.location.href="{{url()->current()}}";
                    } else {
                        toastr.error("Yenidən cəhd göstərin");
                    }
                },
                error: function(data) {
                    if (data == 0) {
                        toastr.error("Yenidən cəhd göstərin");
                    } else {
                        toastr.success("Məlumat yükləndi");
                        $('#exampleModal').modal('toggle');
                        window.location.href="{{url()->current()}}";
                    }
                }
            });
        }
    </script>
    {{-- Edit function --}}
    <script>
        function getEdit(id){

            var url='{{env('APP_URL')}}/home/attributes/'+id;
            $.ajax({
                url: `${url}`,
                dataType: 'json',
                type: 'get',
                success: function(data) {

                    $("form#attributeUpdate input#attribute_id").val(data['id']);
                    $("form#attributeUpdate input#attribute_az_name").val(data['name']['az_name']);
                    $("form#attributeUpdate input#attribute_ru_name").val(data['name']['ru_name']);
                    $("form#attributeUpdate input#attribute_en_name").val(data['name']['en_name']);
                    $("form#attributeUpdate select#attribute_group").val(data['type']);
                    if(data['group_id'] != null || data['group_id'] !==null ){
                        $('form#attributeUpdate div#getGrrId').css('display','block');
                        $('form#attributeUpdate div#getGrrId').removeClass('d-none');
                        $("form#attributeUpdate select#group_id").val(data['group_id'] ?? null);
                    }else{
                        $('form#attributeUpdate div#getGrrId').css('display','none');
                        $('form#attributeUpdate div#getGrrId').addClass('d-none');
                    }
                    $("form#attributeUpdate select#datatype").val(data['datatype']);
                    $("form#attributeUpdate input#attribute_order").val(data['order']);
                    $("form#attributeUpdate input#attribute_filter").prop('checked',data['status']);
                    $('#editModal').modal('toggle');
                },
                error: function (data) {
                    toastr.error("Yenidən cəhd göstərin");
                }

            })
        }
    </script>
    {{-- Edit function --}}
    {{-- Change Stat --}}
    <script>
        function changeStat(id,filter){
            var  token = $("meta[name='_token']").attr('content');

            var url='{{env('APP_URL ')}}/home/attributes_change_stat/'+id;
            $.ajax({
                url: `${url}`,
                dataType: 'json',
                data:{
                    filter:filter,
                    _token: token
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
    {{-- Change Stat --}}
    <script>
        // Attach a submit handler to the form
        function attributeUpdate() {
            // Stop form from submitting normally
            event.preventDefault();
            // Get some values from elements on the page:
            var
                az_name = $("form#attributeUpdate input#attribute_az_name").val(),
                ru_name = $("form#attributeUpdate input#attribute_ru_name").val(),
                en_name = $("form#attributeUpdate input#attribute_en_name").val(),
                type = $("form#attributeUpdate select#attribute_group").val(),
                group_id = $("form#attributeUpdate select#group_id").val(),
                datatype = $("form#attributeUpdate select#datatype").val(),
                order = $("form#attributeUpdate input#attribute_order").val(),
                filter = $("form#attributeUpdate input#attribute_filter").prop('checked');
            var name = {};
            name['az_name'] = az_name;
            name['ru_name'] = ru_name;
            name['en_name'] = en_name;
            token = $("input[name='_token']").val();
            var id =$("form#attributeUpdate input#attribute_id").val();
            var posting = $.ajax({
                url: '{{env('APP_URL ')}}/home/attributes/'+id,
                dataType: 'json',
                data: {
                    name: name,
                    type:type,
                    group_id:group_id,
                    datatype:datatype,
                    order:order,
                    filter:filter==true ? 1 : 0,
                    _token: token
                },
                type: 'patch',
                success: function(data) {
                    if (data == 1) {
                        // toastr.success("Məlumat yeniləndi");
                        $('#editModal').modal('toggle');
                        $("form#attributeUpdate input#attribute_id").val();
                        $("form#attributeUpdate input#attribute_az_name").val();
                        $("form#attributeUpdate input#attribute_ru_name").val();
                        $("form#attributeUpdate input#attribute_en_name").val();
                        window.location.href="{{url()->current()}}";
                    } else {
                        toastr.error("Yenidən cəhd göstərin");
                    }
                },
                error: function(data) {
                    if (data == 0) {
                        toastr.error("Yenidən cəhd göstərin");
                    } else {
                        toastr.success("Məlumat yeniləndi");
                        $('#editModal').modal('toggle');
                        window.location.href="{{url()->current()}}";
                    }
                }
            });
        }
    </script>
    <!-- Atribute Group Activate -->
    <script>
        $("div#getGrrId").css('display','none');
        $('select#attribute_group').on('change',function(){
            // $('#getGrrId').empty();
            if(this.value==0){
                $('div#getGrrId').css('display','block');
                $('div#getGrrId').removeClass('d-none');
            }else{
                $('div#getGrrId').css('display','none');
                $('div#getGrrId').addClass('d-none');
            }
        })
    </script>


    <script type="text/javascript"
            src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/r-2.2.7/rr-1.2.7/datatables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

    <!-- DataTables  & Plugins -->
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
