@extends('layouts.dashboard')
@section('title')
    @if(isset($setting) && $setting != null)
        Setting Edit
    @else
        Setting Create
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
    <!-- Theme style -->
    <link href="{{ asset('dashboard/plugins/tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css"
          media="screen"/>

@endsection
@section('dashboard.content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>
                            @if(isset($setting) && $setting != null)
                                Setting Edit
                            @else
                                Setting Create
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
                        action="@if(isset($setting)) {{ route('settings.update',$setting->id) }} @else {{ route('settings.store') }}   @endif"

                          method = "POST"
                         enctype="multipart/form-data" >
                    @csrf
                    @if(isset($setting) && $setting!=null)
                        @method('PUT')
                    @endif
                    <!-- /.card-header -->

                        <div class="card-body">
                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-content-below-image-tab" data-toggle="pill"
                                       href="#image" role="tab"
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
                                <div class="tab-pane fade show active" id="image" role="tabpanel"
                                     aria-labelledby="custom-content-below-image-tab">

                                    <div class="row">

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            @if(isset($setting) && $setting != null)
                                                <div class="avatar-lg">
                                                    <div class="avatar-title bg-light rounded">
                                                        <img
                                                            src="{{ isset($setting) && $setting != null && isset($setting->logos['logo_lt_web']) ? $setting->logos['logo_lt_web'] : asset('assets/images/favicon.ico') }}"
                                                            id="img-preview" class="avatar-md h-auto" height="200"
                                                            width="200">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label>Logo lt web</label>
                                                <input type="file"
                                                       class="form-control @error('logo_lt_web') is-invalid @enderror"
                                                       name="logo_lt_web">

                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            @if(isset($setting) && $setting != null)
                                                <div class="avatar-lg">
                                                    <div class="avatar-title bg-light rounded">
                                                        <img
                                                            src="{{ isset($setting) && $setting != null && isset($setting->logos['logo_for_dark_web']) ? $setting->logos['logo_for_dark_web'] : asset('assets/images/favicon.ico') }}"
                                                            id="img-preview" class="avatar-md h-auto" height="200"
                                                            width="200">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label>Logo lt Dark Web</label>
                                                <input type="file"
                                                       class="form-control @error('logo_for_dark_web') is-invalid @enderror"
                                                       name="logo_for_dark_web">

                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <h2>Sosial media linklər</h2>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Facebook Url</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['facebook_url'] != null? $setting->social_network['facebook_url']: null }}"
                                                           class="form-control" name="facebook_url">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Linkedin Url</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['linkedin_url'] != null? $setting->social_network['linkedin_url']: null }}"
                                                           class="form-control" name="linkedin_url">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Instagram Url</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['instagram_url'] != null? $setting->social_network['instagram_url']: null }}"
                                                           class="form-control" name="instagram_url">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Youtube Url</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['youtube_url'] != null? $setting->social_network['youtube_url']: null }}"
                                                           class="form-control" name="youtube_url">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Google Maps</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['gmaps_url'] != null? $setting->social_network['gmaps_url']: null }}"
                                                           class="form-control" name="gmaps_url">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Telegram Url 1</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['telegram_url_1'] != null? $setting->social_network['telegram_url_1']: null }}"
                                                           class="form-control" name="telegram_url_1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Telegram Url 2</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['telegram_url_2'] != null? $setting->social_network['telegram_url_2']: null }}"
                                                           class="form-control" name="telegram_url_2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Telefon 1 </label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['phone_1'] != null? $setting->social_network['phone_1']: null }}"
                                                           class="form-control" name="phone_1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Telefon 2</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['phone_2'] != null? $setting->social_network['phone_2']: null }}"
                                                           class="form-control" name="phone_2">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Whatsapp 1</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['whatsapp_1'] != null? $setting->social_network['whatsapp_1']: null }}"
                                                           class="form-control" name="whatsapp_1">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">Whatsapp 2</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['whatsapp_2'] != null? $setting->social_network['whatsapp_2']: null }}"
                                                           class="form-control" name="whatsapp_2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">E-mail 1</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['email_1'] != null? $setting->social_network['email_1']: null }}"
                                                           class="form-control" name="email_1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                                            <div class="form-group">
                                                <label class="form-label">E-mail 2</label>
                                                <div class="controls">
                                                    <input type="text"
                                                           value="{{ $setting != null && $setting->social_network != null && $setting->social_network['email_2'] != null? $setting->social_network['email_2']: null }}"
                                                           class="form-control" name="email_2">
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <br>


                                </div>
                                <div class="tab-pane fade" id="az" role="tabpanel"
                                     aria-labelledby="custom-content-below-az-tab">

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text"
                                               class="form-control @error('az_address') is-invalid @enderror"
                                               name="az_address"
                                               value="@if(isset($setting)) {{ $setting->address['az_address'] }} @else {{ old('az_address') }} @endif">

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="en" role="tabpanel"
                                     aria-labelledby="custom-content-below-en-tab">

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text"
                                               class="form-control @error('en_address') is-invalid @enderror"
                                               name="en_address"
                                               value="@if(isset($setting)) {{ $setting->address['en_address'] }} @else {{ old('en_address') }} @endif">

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="ru" role="tabpanel"
                                     aria-labelledby="custom-content-below-ru-tab">

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text"
                                               class="form-control @error('ru_address') is-invalid @enderror"
                                               name="ru_address"
                                               value="@if(isset($setting)) {{ $setting->address['ru_address'] }} @else {{ old('ru_address') }} @endif">

                                    </div>


                                </div>
                            </div>

                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="col-12">
                                <a href="{{ route('settings.index') }}" class="btn btn-secondary">Cancel</a>
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

    @include('layouts.ckeditor.ckeditorService', [
       'uploadUrl' => route('ckEditorUpload'),
       'editors' => [
           'az_description',
           'ru_description',
           'en_description',
       ],
   ])
    <script src="{{ asset('dashboard/plugins/tagsinput/js/bootstrap-tagsinput.min.js') }}"
            type="text/javascript"></script>
    <!-- Select2 -->
    <script src="{{ asset('dashboard/plugins/select2/js/select2.full.min.js') }}"></script>
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
