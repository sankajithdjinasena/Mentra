<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Focuzen | Admin DashBoard</title>
    <link rel="shortcut icon" href="{{ asset('system/images/logo.jpg') }}" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <script src="https://use.fontawesome.com/979d2f37de.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('system/css/myadmin.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/checkbox.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">

</head>

<body
    class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed dark-mode layout-footer-fixed sidebar-collapse">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a title="Click to Visit Website" href="" class="nav-link" target="_blank"
                        style="padding: 0 17px;"><img style="width: 40px;" src="{{ asset('system/images/logo.jpg') }}"
                            alt="logo"></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a title="Click to {{ __('Logout') }}" class="nav-link" href="{{ route('logout') }}"
                        role="button"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i style="color: #ff7979" class="fas fa-lock-open"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar mt-3">
                <div class="user-panel pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('system/images/6915987.png') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block" title="My Profile">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>




                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-collapse-hide-child nav-legacy nav-flat"
                        data-widget="treeview" role="menu" data-accordion="false">


                        @if (Auth::user()->status == '2')
                            <li class="nav-item">
                                <a href="{{ asset('/dashboard') }}"
                                    class="nav-link {{ Request::segment(1) === 'dashboard' ? 'active bg-success' : null }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ asset('dash_users') }}"
                                    class="nav-link  {{ Request::segment(1) === 'dash_users' ? 'active bg-secondary' : '' }}">
                                    <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                                    <p>Users</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ asset('dash_challenge') }}"
                                    class="nav-link  {{ Request::segment(1) === 'dash_challenge' ? 'active bg-secondary' : '' }}">
                                    <i class="fa fa-tasks nav-icon" aria-hidden="true"></i>
                                    <p>Add Challenges</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('dash_article') }}"
                                    class="nav-link  {{ Request::segment(1) === 'dash_article' ? 'active bg-secondary' : '' }}">
                                    <i class="fa fa-book nav-icon" aria-hidden="true"></i>
                                    <p>Add Articles</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ asset('dash_viewchallenge') }}"
                                    class="nav-link  {{ Request::segment(1) === 'dash_viewchallenge' ? 'active bg-secondary' : '' }}">
                                    <i class="fa fa-list-ul nav-icon" aria-hidden="true"></i>
                                    <p>View Challenges</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('Article.index') }}"
                                    class="nav-link {{ Request::is('admin/articles') ? 'active bg-secondary' : '' }}">
                                    <i class="fa fa-newspaper nav-icon" aria-hidden="true"></i>
                                    <p>View Article</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ asset('dash_feedbacks') }}"
                                    class="nav-link  {{ Request::segment(1) === 'dash_feedbacks' ? 'active bg-secondary' : '' }}">
                                    <i class="fa fa-comments nav-icon" aria-hidden="true"></i>
                                    <p>Feedbacks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('dash_top') }}"
                                    class="nav-link  {{ Request::segment(1) === 'dash_top' ? 'active bg-secondary' : '' }}">
                                    <i class="fa fa-star nav-icon" aria-hidden="true"></i>
                                    <p>Top study focurs</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ asset('permission_denied') }}" class="nav-link ">
                                    <i class="nav-icon fas fa-exclamation-triangle text-danger"></i>
                                    <p class="text-danger">permission denied</p>
                                </a>
                            </li>
                        @endif





                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer py-2"
            style="background-color: #343a40; font-size: 16px; border-top: 1px solid #343a40;">
            <div class="container-fluid">
                <div class="row align-items-center text-center text-md-start">
                    <div class="offset-md-3 col-md-6 justify-content-md-center align-self-center mb-5 mb-md-0">
                        <span id="getYear">{{ date('Y') }}</span> &copy; &nbsp; &nbsp;
                        <a href="{{ route('/') }}" target="_blank">
                            <img src="{{ asset('img/logo-png - Copy.png') }}" alt="FocusZen Copyright"
                                style="height: 22px; vertical-align: middle;">
                        </a>
                        <span class="ms-2">&nbsp;&nbsp; &nbsp; All rights reserved.</span>
                    </div>

                </div>
            </div>
        </footer>




        <script type="text/javascript">
            var getYear = new Date().getFullYear();
            document.getElementById('getYear').innerHTML = getYear;
        </script>



        <aside class="control-sidebar control-sidebar-dark">

        </aside>


    </div>




    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>
    <!-- select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            $("#cusmsg").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#cusmsg_wrapper .col-md-6:eq(0)');

            $("#allads").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#allads_wrapper .col-md-6:eq(0)');


        });
    </script>



    <script>
        function ImageInput(element) {
            // Variables
            var $wrapper = element;
            var $file = $wrapper.querySelector('input[type=file]');
            var $input = $wrapper.querySelector('input[type=hidden]');
            var $img = $wrapper.querySelector('img');
            var maxSize = Number($file.getAttribute('max-size'));
            var types = $file.accept.split(',');

            var api = {
                onInvalid: onInvalid,
                onChanged: onChanged,
            };

            // Methods
            function fileHandler(e) {
                var file = $file.files.length && $file.files[0];

                if (!file) return;

                var errors = checkValidity(file);

                if (errors) {
                    api.onInvalid(errors);
                    $file.value = null;
                    return;
                }

                api.onChanged(file, update, $wrapper)
            }

            function humanizeFormat(string) {
                return string.replace(/.*?\//, '');
            }

            function checkValidity(file) {
                var errors = [];

                types.includes(file.type) || errors.push('Format file harus: ' + types.map(humanizeFormat).join(', '));
                file.size < maxSize || errors.push('Ukuran file maksimal ' + maxSize / 1000000 + 'MB');

                return errors.length ? errors : false;
            }

            function getFileData(file, callback) {
                var reader = new FileReader();

                reader.addEventListener("load", function() {
                    callback(reader.result);
                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            function update(data) {
                $img.src = data;
                $input.value = data;
            }

            function onInvalid(errors) {
                alert(errors.join('. '));
            }

            function onChanged(file, update, $wrapper) {
                console.log('.onChanged called');
                getFileData(file, update);
            }

            // Init
            $file.addEventListener('change', fileHandler);

            return api;
        };

        document.querySelectorAll('.image-input').forEach(_ => {
            var imageInput = new ImageInput(_);
            _.addEventListener("click", (e) => {
                if (e.target.classList.contains('image-remove')) {
                    _.remove()
                }
            });



            if (_.classList.contains('withAjax')) {
                imageInput.onChanged = customOnChanged;

            }

            function customOnChanged(file, update, $el) {
                if (!$el.nextElementSibling) {
                    var $remove = document.createElement('button');
                    $remove.className = "image-remove";

                    var $new = $el.cloneNode(true);
                    $new.querySelector('input[type=hidden]').value = "";
                    $new.querySelector('input[type=file]').value = "";
                    $new.querySelector('img').src = "";

                    $el.parentElement.append($new);
                    $el.append($remove);

                    var imageInput = new ImageInput($new);
                    imageInput.onChanged = customOnChanged;
                }

                $el.classList.add('isUploading');
                setTimeout(function() {
                    update('https://placekitten.com/200/300');
                    $el.classList.remove("isUploading");
                }, 3000);

            };

        });
    </script>

</body>

</html>
