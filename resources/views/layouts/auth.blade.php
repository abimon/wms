<!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Usalama Admin</title>
        <!-- base:css -->
        <link rel="stylesheet" href="/storage/front/vendors/typicons/typicons.css">
        <link rel="stylesheet" href="/storage/front/vendors/css/vendor.bundle.base.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="/storage/front/css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="/storage/front/images/favicon.ico" />
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-start py-5 px-4 px-sm-5">
                                <div class="brand-logo">
                                    <img src="/storage/front/images/logo-dark.svg" alt="logo">
                                </div>
                                @yield('form')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- base:js -->
        <script src="/storage/front/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- inject:js -->
        <script src="/storage/front/js/off-canvas.js"></script>
        <script src="/storage/front/js/hoverable-collapse.js"></script>
        <script src="/storage/front/js/template.js"></script>
        <script src="/storage/front/js/settings.js"></script>
        <script src="/storage/front/js/todolist.js"></script>
        <!-- endinject -->
    </body>

    </html>