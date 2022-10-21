<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->


        <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; witdth:50%; padding:30px">
            <div class="box">

                <div class="img-box" style="padding: 20px">
                    <img src="{{asset('storage/'.$value->image)}}" alt="">
                </div>
                <div class="detail-box">
                    <h5>Name:
                        {{$value->product_id}}
                    </h5>

                    <h5>Payment Status:
                        {{$value->payment_status}}
                    </h5>
                    <h5>Quantity:
                        {{$value->quantity}}
                    </h5>
                    <h5>Price:
                        {{$value->price}}
                    </h5>
                    <h6 style="color: blue">
                        ${{$value->price}}
                    </h6>





                </div>
            </div>
        </div>


        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->
    </div>

    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>
    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="js/custom.js')}}"></script>

</body>

</html>