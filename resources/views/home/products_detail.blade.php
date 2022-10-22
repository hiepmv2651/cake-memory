<!DOCTYPE html>
<html>

<head>
    @include('home.css')
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
    @include('home.js')

</body>

</html>