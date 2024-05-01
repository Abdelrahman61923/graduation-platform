@extends('layouts.master')
@section('title')
    {{ __('Upload Book') }}
@endsection
@section('content')
<div class="page-body">

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>{{ __('Upload Documentation') }}</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('students.dashboard')}}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">{{ __('Upload Book') }}</li>
                    </ol>
                </div>
            </div>
        </div>


        <!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="pixelstrap">
  <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/icofont.css">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify.css">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/flag-icon.css">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/feather-icon.css">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/date-picker.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/dropzone.css">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
</head>
<body>



  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper default-wrapper" id="pageWrapper">
    <!-- Page Header Start-->








    

<!--         Container-fluid starts
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                  <div class="form theme-form">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label>Project Name</label>
                          <input class="form-control" type="text" placeholder="Project name *">
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label>Project Rate</label>
                          <input class="form-control" type="text" placeholder="Enter project Rate">
                        </div>
                      </div>


                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label>Project Type</label>
                          <select class="form-select">
                            <option>ًWebsite</option>
                            <option>Mobile App</option>
                            <option>other</option>
                          </select>
                        </div>
                      </div>



                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label>Supervisor Name</label>
                          <select class="form-select">
                            <option>ًDr.Ahmed Elharby</option>
                            <option>ًDr.....</option>
                          </select>
                        </div>
                      </div>



                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label>Starting date</label>
                          <input class="datepicker-here form-control" type="text" data-language="en">
                        </div>
                      </div>



                      <div class="col-sm-4">
                        <div class="mb-3">
                          <label>Ending date</label>
                          <input class="datepicker-here form-control" type="text" data-language="en">
                        </div>
                      </div>
                    </div>
 -->




                   <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label>Upload Documentation Book (PDF only)</label>
                          <form class="dropzone" id="singleFileUpload" action="/upload.php">
                          <input class="form-control" type="file" aria-label="file example" required="">
                          <small class="form-text text-muted">Max file size: 10MB per file</small>

                            <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                              <h6>Drop files here or click to upload.</h6><span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                            </div>
                          </form>
                    </div>




                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
<!--                                 Choose file for presentation 
 -->                                <label>Upload Presentation (PDF, PPT, or PPTX)</label>
                                <div>
                                    <input class="form-control" type="file" aria-label="file example" required="">
                                    <small class="form-text text-muted">Max file size: 10MB per file</small>

                                    <div class="invalid-feedback">Example invalid form file feedback</div>
                                </div>
                    </div> 


                        





                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="text-end"><a class="btn btn-success me-3" href="#">Add</a><a class="btn btn-danger" href="#">Cancel</a></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>

    </div>
  </div>
  <!-- latest jquery-->
  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap js-->
  <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <!-- feather icon js-->
  <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
  <!-- scrollbar js-->
  <script src="../assets/js/scrollbar/simplebar.js"></script>
  <script src="../assets/js/scrollbar/custom.js"></script>
  <!-- Sidebar jquery-->
  <script src="../assets/js/config.js"></script>
  <!-- Plugins JS start-->
  <script src="../assets/js/sidebar-menu.js"></script>
  <script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
  <script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
  <script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
  <script src="../assets/js/dropzone/dropzone.js"></script>
  <script src="../assets/js/dropzone/dropzone-script.js"></script>
  <script src="../assets/js/typeahead/handlebars.js"></script>
  <script src="../assets/js/typeahead/typeahead.bundle.js"></script>
  <script src="../assets/js/typeahead/typeahead.custom.js"></script>
  <script src="../assets/js/typeahead-search/handlebars.js"></script>
  <script src="../assets/js/typeahead-search/typeahead-custom.js"></script>
  <script src="../assets/js/tooltip-init.js"></script>
  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="../assets/js/script.js"></script>
  <script src="../assets/js/theme-customizer/customizer.js"></script>
  <!-- login js-->
  <!-- Plugin used-->
</body>
</html>



    </div>

</div>
@endsection
