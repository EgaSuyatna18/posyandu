<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ $title }}</title>
        <link href="/assets/sbadmin/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="/assets/datatables/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="/assets/datatables/css/dataTables.dateTime.min.css">
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/dashboard">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="/info">
                                <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                                Informasi
                            </a>
                            <a class="nav-link" href="/hasil_penimbangan">
                                <div class="sb-nav-link-icon"><i class="fas fa-scale-balanced"></i></div>
                                Hasil Penimbangan
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid p-4">
                        <h1 class="my-4 text-muted">{{ $title }}</h1>
                        @yield('content')
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
                @if (session()->has('notif'))
                    <i class="fa fa-check btn btn-success btn-sm"></i>
                @elseif ($errors->any())
                    <i class="fa fa-times btn btn-danger btn-sm"></i>
                @endif
                <strong class="me-auto ms-3">Notifikasi</strong>
                <small>just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                @if (session()->has('notif'))
                    <p class="text-success">{{ session()->get('notif') }}</p>
                @elseif ($errors->any())
                    <ol class="text-danger">
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ol>
                @endif
              </div>
            </div>
          </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/assets/sbadmin/js/scripts.js"></script>
        <script src="/assets/jquery/jquery.js"></script>
        <script src="/assets/datatables/js/jquery.dataTables.min.js"></script>
        <script src="/assets/datatables/js/dataTables.bootstrap5.min.js"></script>
        <script src="/assets/datatables/js/dataTables.buttons.min.js"></script>
        <script src="/assets/datatables/js/jszip.min.js"></script>
        <script src="/assets/datatables/js/pdfmake.min.js"></script>
        <script src="/assets/datatables/js/vfs_fonts.js"></script>
        <script src="/assets/datatables/js/buttons.html5.min.js"></script>
        <script src="/assets/datatables/js/buttons.print.min.js"></script>
        <script src="/assets/datatables/js/moment.min.js"></script>
        <script src="/assets/datatables/js/dataTables.dateTime.min.js"></script>
        
        <script>
            $(document).ready(function () {

                $('#dtReport thead tr')
                    .clone(true)
                    .addClass('filters')
                    .appendTo('#dtReport thead');

                    var minDate, maxDate;
 
                // Custom filtering function which will search data in column four between two values
                $.fn.dataTable.ext.search.push(
                    function( settings, data, dataIndex ) {
                        var min = minDate.val();
                        var max = maxDate.val();
                        var date = new Date( data[1] );

                        if (
                            ( min === null && max === null ) ||
                            ( min === null && date <= max ) ||
                            ( min <= date   && max === null ) ||
                            ( min <= date   && date <= max )
                        ) {
                            return true;
                        }
                        return false;
                    }
                );

                minDate = new DateTime($('#min'), {
                    format: 'YYYY-mm-d'
                });
                maxDate = new DateTime($('#max'), {
                    format: 'YYYY-mm-d'
                });

                $('#datatables').DataTable();

                $('#dtOT').DataTable({
                    lengthChange: false
                });

                var table = $('#dtReport').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'pdfHtml5',

                            title: '{{ $title }}',
                            message: "Posyandu Cendrawasih \n Jl. Swadaya RT 03 / RW 02 Desa Bumi Harapan \n {{ $title }}",
                            className: 'btn btn-info'
                        }
                    ],
                    orderCellsTop: true,
                    fixedHeader: true,
                    initComplete: function () {
                        var api = this.api();
            
                        // For each column
                        api
                            .columns()
                            .eq(0)
                            .each(function (colIdx) {
                                // Set the header cell to contain the input element
                                var cell = $('.filters th').eq(
                                    $(api.column(colIdx).header()).index()
                                );
                                var title = $(cell).text();
                                $(cell).html('<input type="text" placeholder="' + title + '" />');
            
                                // On every keypress in this input
                                $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                    .off('keyup change')
                                    .on('change', function (e) {
                                        // Get the search value
                                        $(this).attr('title', $(this).val());
                                        var regexr = '({search})'; //$(this).parents('th').find('select').val();
            
                                        var cursorPosition = this.selectionStart;
                                        // Search the column for that value
                                        api
                                            .column(colIdx)
                                            .search(
                                                this.value != ''
                                                    ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                    : '',
                                                this.value != '',
                                                this.value == ''
                                            )
                                            .draw();
                                    })
                                    .on('keyup', function (e) {
                                        e.stopPropagation();
            
                                        $(this).trigger('change');
                                        $(this)
                                            .focus()[0]
                                            .setSelectionRange(cursorPosition, cursorPosition);
                                    });
                            });
                    },
               }); 
               $('#min, #max').on('change', function () {
                table.draw();
            });
            });

        </script>

        @if ($errors->any() || session()->has('notif'))
            <script>
                window.onload = (event)=> {
                    let myAlert = document.querySelector('#liveToast');
                    let bsAlert = new  bootstrap.Toast(myAlert);
                    bsAlert.show();
                }
            </script>
        @endif
    </body>
</html>