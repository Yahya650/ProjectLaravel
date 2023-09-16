<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>404-Error</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/401pageStyle/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="/401pageStyle/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="/401pageStyle/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="/401pageStyle/images/fevicon.png" type="image/gif" />
    <!-- jQuery -->
    <script src="{{ url('/css&js/jquery-3.6.4.min.js') }}"></script>
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <style>

    </style>
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout template2">
    <div class="mobile_section pt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="demo_box text_align_center margino">
                        <h1>Sorry</h1>
                        <figure><img src="/401pageStyle/images/demo2.png" alt="#" /></figure>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="creative text_align_center">
                        <span>Page </span>
                        <p>The page you requested can not be found in our system</p>
                        <div class="d-flex mx-auto" style="max-width: 80vh">
                            <a class="read_more mx-1" href="{{ route('home') }}">Go to home</a>
                            <a class="read_more go-back-button mx-1" href="javascript:void(0)">Go back</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end mobile_section -->
    <!-- Javascript files-->
    <script>
        $(document).ready(function() {
            $(".go-back-button").click(function() {
                window.history.back();
            });
        });
    </script>
    <script src="/401pageStyle/js/jquery.min.js"></script>
    <script src="/401pageStyle/js/bootstrap.bundle.min.js"></script>
    <script src="/401pageStyle/js/custom.js"></script>
</body>

</html>
