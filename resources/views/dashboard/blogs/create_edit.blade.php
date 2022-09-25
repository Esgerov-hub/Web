@extends('layouts.dashboard')
@section('title')
    @if(isset($blog) && $blog != null)
        Blog Edit
    @else
        Blog Create
    @endif
@endsection
@section('dashboard.css')

    <link rel="stylesheet" href="{{ asset('dashboard/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{ asset('dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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
                        <h1>
                            @if(isset($blog) && $blog != null)
                                Blog Edit
                            @else
                                Blog Create
                            @endif
                        </h1>
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
                    <form
                        action="{{ isset($blog) && $blog!=null ? route('blogs.update',$blog->id) :route('blogs.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                    @csrf
                    @if(isset($blog) && $blog!=null)
                        @method('PUT')
                    @endif
                    <!-- /.card-header -->

                        <div class="card-body">
                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-content-below-other-tab" data-toggle="pill"
                                       href="#other" role="tab"
                                       aria-controls="custom-content-below-image" aria-selected="true">Other</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-az-tab" data-toggle="pill"
                                       href="#az" role="tab"
                                       aria-controls="custom-content-below-az" aria-selected="false">AZ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-en-tab" data-toggle="pill"
                                       href="#en" role="tab"
                                       aria-controls="custom-content-below-en" aria-selected="false">EN</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-content-below-ru-tab" data-toggle="pill"
                                       href="#ru" role="tab"
                                       aria-controls="custom-content-below-ru" aria-selected="false">RU</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="custom-content-below-tabContent">
                                <div class="tab-pane fade show active" id="other" role="tabpanel"
                                     aria-labelledby="custom-content-below-other-tab">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            @if(isset($blog) && $blog != null)
                                                <div class="avatar-lg">
                                                    <div class="avatar-title bg-light rounded">
                                                        <img src="{{ isset($blog) && $blog != null && isset($blog->image) ? $blog->image : asset('assets/images/favicon.ico') }}"
                                                             id="img-preview" class="avatar-md h-auto" height="200" width="200">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                       
                                        <div class="col-sm-6">
                                            @if(isset($blog) && $blog != null)
                                                <div class="avatar-lg">
                                                    <div class="avatar-title bg-light rounded">
                                                        <img src="{{ isset($blog) && $blog != null && isset($blog->images->image) ? $blog->images->image : asset('assets/images/favicon.ico') }}"
                                                             id="img-preview" class="avatar-md h-auto" height="200" width="200">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Şəkil</label>
                                                    <div class="controls">
                                                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Additional Images</label>
                                                    <div class="controls">
                                                        <input type="file" class="form-control @error('additional_images') is-invalid @enderror" name="additional_images" >
                                                    </div>
                                                </div>
                                            </div>
                                               
                                        </div>
                                        <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">  Kateqoriya</label>
                                                    <div class="controls">
                                                        <select name="category_id" id="" class="form-control @error('category_id') is-invalid @enderror">
                                                            <option value="">Bir kateqoriya seçin</option>
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->id }}" @if(isset($blog)) @if($blog->category_id == $cat->id) selected @endif @elseif(old('category_id') == $cat->id) selected @endif>
                                                                    {{ $cat->name['az_name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label"> Status</label>
                                                    <div class="controls">
                                                        <select name="status" id="" class="form-control">
                                                            <option value="">Bir status seçin</option>
                                                           
                                                                <option value="1" @if(isset($blog)) @if($blog->status == 1) selected @endif @elseif(old('status') == 1) selected @endif>Active</option>
                                                                <option value="2" @if(isset($blog)) @if($blog->status == 2) selected @endif @elseif(old('status') == 2) selected @endif>NoActive</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label"> Tip</label>
                                                    <div class="controls">
                                                        <select name="type" required class="form-control">
                                                            <option value="0" @if(isset($blog)) @if($blog->type == 0) selected @endif @elseif(old('type') == 0) selected @endif>Bir tip seçin</option>
                                                            <option value="1" @if(isset($blog)) @if($blog->type == 1) selected @endif @elseif(old('type') == 1) selected @endif>Bloq</option>
                                                            <option value="2" @if(isset($blog)) @if($blog->type == 2) selected @endif @elseif(old('type') == 2) selected @endif>Kampaniya</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br>

                                </div>
                                <div class="tab-pane fade" id="az" role="tabpanel"
                                     aria-labelledby="custom-content-below-az-tab">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control @error('az_name') is-invalid @enderror" name="az_name" value="@if(isset($blog)) {{ $blog->title['az_name'] }} @else {{ old('az_name') }} @endif" >

                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control az_description"
                                                  placeholder="Açıqlama daxil edin ..." name="az_description"
                                                  style="width: 100%; height: 300px; font-size: 14px; line-height: 23px;padding:15px;">@if(isset($blog)) {!! $blog->description['az_description'] !!} @else {!! old('az_description') !!} @endif</textarea>
                                    </div>

                                    <br>
                                    
                                    @include('layouts.seo.createseo', [
                                        'langKey' => 'az',
                                        'data' => isset($blog) && isset($blog->id) && $blog != null  ? $blog->seo : null,
                                    ])

                                </div>
                                <div class="tab-pane fade" id="en" role="tabpanel"
                                     aria-labelledby="custom-content-below-en-tab">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control @error('en_name') is-invalid @enderror" name="en_name" value="@if(isset($blog)) {{ $blog->title['en_name'] }} @else {{ old('en_name') }} @endif" >

                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control en_description"
                                                  placeholder="Açıqlama daxil edin ..." name="en_description"
                                                  style="width: 100%; height: 300px; font-size: 14px; line-height: 23px;padding:15px;">@if(isset($blog)) {!! $blog->description['en_description'] !!} @else {!! old('en_description') !!} @endif</textarea>
                                    </div>
                                    <br>
                                    @include('layouts.seo.createseo', [
                                        'langKey' => 'en',
                                        'data' => isset($blog) && isset($blog->id) && $blog != null  ? $blog->seo : null,
                                    ])
                                </div>
                                <div class="tab-pane fade" id="ru" role="tabpanel"
                                     aria-labelledby="custom-content-below-ru-tab">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control @error('ru_name') is-invalid @enderror" name="ru_name" value="@if(isset($blog)) {{ $blog->title['ru_name'] }} @else {{ old('ru_title') }} @endif" >

                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control ru_description @error('ru_description') is-invalid @enderror" id="summernote"
                                                  placeholder="Açıqlama daxil edin ..." name="ru_description"
                                                  style="width: 100%; height: 300px; font-size: 14px; line-height: 23px;padding:15px;">@if(isset($blog)) {!! $blog->description['ru_description'] !!} @else {!! old('ru_description') !!} @endif</textarea>
                                    </div>
                                    <br>
                                    @include('layouts.seo.createseo', [
                                        'langKey' => 'ru',
                                        'data' => isset($blog) && isset($blog->id) && $blog != null  ? $blog->seo : null,
                                    ])
                                </div>
                            </div>

                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="col-12">
                                <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success float-right">Save</button>
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
    @include('layouts.seo.createseoscript')
    @include('layouts.ckeditor.ckeditorService', [
       'uploadUrl' => route('ckEditorUpload'),
       'editors' => [
           'az_description',
           'ru_description',
           'en_description',
           
       ],
   ])
    <script src="{{ asset('dashboard//plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
            //Money Euro
            $('[data-mask]').inputmask()

            //Date picker
            $('#reservationdate').datetimepicker({
                format: 'L'
            });

            //Date and time picker
            $('#reservationdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

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
            $('#daterange-btn').daterangepicker(
                {
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
                function (start, end) {
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

            $('.my-colorpicker2').on('colorpickerChange', function (event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })

            $("input[data-bootstrap-switch]").each(function () {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

        })
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
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

        myDropzone.on("addedfile", function (file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function () {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function (file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function (progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function () {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function () {
            myDropzone.removeAllFiles(true)
        }
        // DropzoneJS Demo Code End
    </script>

@endsection
