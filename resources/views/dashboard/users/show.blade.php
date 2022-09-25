@extends('layouts.dashboard')
@section('title')
Users Show
@endsection
@section('dashboard.css')

<link rel="stylesheet" href="{{ asset('dashboard/plugins/daterangepicker/daterangepicker.css') }}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{ asset('dashboard/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{ asset('dashboard/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<!-- BS Stepper -->
<link rel="stylesheet" href="{{ asset('dashboard/plugins/bs-stepper/css/bs-stepper.min.css') }}">
<!-- dropzonejs -->
<link rel="stylesheet" href="{{ asset('dashboard/plugins/dropzone/min/dropzone.min.css') }}">

@endsection
@section('dashboard.content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Show User</h1>
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
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('users.show',$user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="avatar-lg">
                                    <div class="avatar-title bg-light rounded">
                                        <img src="{{ isset($user) && $user != null && isset($user->photo) ? $user->photo : asset('assets/images/favicon.ico') }}" id="img-preview" class="avatar-md h-auto" height="200" width="200">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" disabled value="{{ $user->phone }}" placeholder="phone" style="width: 100%;">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" disabled style="width: 100%;">
                                        <option value="">-sec</option>
                                        <option value="1" @if(1==$user->type) selected @endif >Admin</option>
                                        <option value="2" @if(2==$user->type) selected @endif>Teacher</option>
                                        <option value="3" @if(3==$user->type) selected @endif>Company</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Verify</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->verify }}" style="width: 100%;">
                                </div>
                                <div class="form-group">
                                    <label>Signature</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->signature }}" style="width: 100%;">
                                </div>
                                @if(isset($user->userBalance))
                                <div class="form-group">
                                    <label>Balance</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->userBalance->price }}" style="width: 100%;">
                                </div>
                                @endif
                                @if(isset($user->updated_at))
                                <div class="form-group">
                                    <label>Update At</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->updated_at->format('d.m.Y') }}" style="width: 100%;">
                                </div>
                                @endif
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <br>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->name_surname  }}" placeholder="Name Surname" style="width: 100%;">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" disabled value="{{ $user->email }}" placeholder="E-mail" style="width: 100%;">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" style="width: 100%;" disabled>
                                        <option value="">-sec</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role }}" @if($role==$userRole->name) selected @endif>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Referal Code</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->referal_code }}" style="width: 100%;">
                                </div>
                                @if(isset($user->userBalance))
                                <div class="form-group">
                                    <label>Currency</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->userBalance->currency }}" style="width: 100%;">
                                </div>
                                <div class="form-group">
                                    <label>Process</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->userBalance->process }}" style="width: 100%;">
                                </div>
                                @endif
                                <div class="form-group">
                                    <label>Created At</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->created_at->format('d.m.Y') }}" style="width: 100%;">
                                </div>
                                @if(isset($user->deleted_at))
                                <div class="form-group">
                                    <label>Deleted At</label>
                                    <input type="text" class="form-control" disabled value="{{ $user->deleted_at->format('d.m.Y') }}" style="width: 100%;">
                                </div>
                                @endif
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <br>
                       
                        @role('Admin')
                        <div class="row">
                            <h2>Accept Comments</h2>
                        </div>
                        <br>
                        <div class="row">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Rating</th>
                                        <!-- <th>Setting</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->comments as $comment)
                                    @if(isset($comment->admin_id))
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->subject }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>{{ $comment->rating }}</td>

                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>

                            </table>




                        </div>

                        

                        <div class="row">
                            <h2>Write Comments</h2>
                        </div>
                        <br>
                        <div class="row">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Rating</th>
                                        <!-- <th>Setting</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->commentsUser as $comment)
                                    @if(isset($comment->user_id))
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->subject }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td>{{ $comment->rating }}</td>

                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>

                            </table>




                        </div>

                        <br>
                        <div class="row">

                            <h2>Contacts</h2>

                        </div>
                        <br>
                        <div class="row">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->contacts as $contact)
                                    @if(isset($contact->user_id))
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->namesurname }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ $contact->message }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->email }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>

                            </table>




                        </div>

                        <br>
                        <div class="row">

                            <h2>Blogs</h2>

                        </div>
                        <br>
                        <div class="row">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->blogs as $blog)
                                    @if(isset($blog->user_id))
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        <td>{{ $blog->title['az_name'] }}</td>
                                        <td>{!! $blog->description['az_description'] !!}</td>

                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>

                            </table>


                        </div>

                        <div class="row">

                            <h2>Notifications</h2>

                        </div>
                        <br>
                        <div class="row">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->notificationsUsers as $notifications)
                                    @if(isset($notifications->user_id))
                                    <tr>
                                        <td>{{ $notifications->id }}</td>
                                        <td>{{ $notifications->name }}</td>
                                        <td>{!! $notifications->value !!}</td>

                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>

                            </table>


                        </div>

                        <div class="row">

                            <h2>Orders</h2>

                        </div>
                        <br>
                        <div class="row">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Order Number</th>
                                        <th>Price</th>
                                        <th>Currency</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->orders as $order)
                                    @if(isset($order->user_id))
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->price }}</td>
                                        <td>{{ $order->currency }}</td>
                                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>

                            </table>

                        </div>

                        <div class="row">

                            <h2>Orders Refunds</h2>

                        </div>
                        <br>
                        <div class="row">
                        <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Refund Reason</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user->ordersRefunds as $orderRefund)
                            @if(isset($orderRefund->user_id))
                                    <tr>
                                        <td>{{ $orderRefund->id }}</td>
                                        <td>{{ $orderRefund->refund_reason }}</td>
                                        <td>{{ $orderRefund->created_at->format('d.m.Y H:i') }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                           
                        </table>
                        </div>


                        <div class="row">

                            <h2>Teach Earnings</h2>

                        </div>

                        <br>
                        <div class="row">
                        <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Percent</th>
                                        <th>Created at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user->teach_earning as $teach)
                            @if(isset($teach->user_id))
                                    <tr>
                                        <td>{{ $teach->id }}</td>
                                        <td>{{ $teach->percent }}</td>
                                        <td>{{ $teach->created_at->format('d.m.Y H:i') }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                           
                        </table>

                        </div>
                        @endrole
                        
                    </div>

            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <div class="col-12">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            </form>
        </div>
        <!-- /.card -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection
@section('dashboard.js')

<script src="{{ asset('dashboard//plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('dashboard/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('dashboard/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('dashboard/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('dashboard/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('dashboard/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('dashboard/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('dashboard/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function() {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })

    myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() {
            myDropzone.enqueueFile(file)
        }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
</script>
@endsection