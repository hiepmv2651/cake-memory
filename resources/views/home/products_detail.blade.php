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
                    <h5>
                        {{$value->title}}
                    </h5>

                    @if ($value->discount_price != null)
                    <h6 style="color: red">
                        ${{$value->discount_price}}
                    </h6>

                    <h6 style="text-decoration: line-through; color:blue">
                        ${{$value->price}}
                    </h6>

                    @else
                    <h6 style="color: blue">
                        ${{$value->price}}
                    </h6>

                    @endif
                    <h6>Product Category: {{$value->category}}</h6>
                    <h6>Product Description: {{$value->description}}</h6>
                    <h6>Product Quantity: {{$value->quantity}}</h6>

                    <form action="{{url('add_cart', $value->id)}}" method="POST">
                        @csrf
                        <input type="number" name="quantity" min="1" value="1">
                        <input type="submit" value="Add To Cart">
                    </form>
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