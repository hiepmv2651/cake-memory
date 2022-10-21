<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
            text-align: center;
        }

        .dataTables_length select {
            background-color: white !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->

        <div class="content-wrapper">
            <div class="div_center">
                <h2 class="h2_font">All Order</h2>
                <div>
                    <table id="example" class="table is-striped" style="width:100%;" style="background-color: white">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                {{-- <th>Phone</th>
                                <th>Address</th>
                                <th>Product Title</th> --}}
                                <th>Quantity Price</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Image</th>
                                <th>Delivery Status</th>
                                <th>Send Email</th>

                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $value)

                            <tr>
                                <td>{{$value->name}}</td>
                                <td>{{$value->email}}</td>
                                {{-- <td>{{$value->phone}}</td>
                                <td>{{$value->address}}</td>
                                <td>{{$value->product_title}}</td> --}}
                                <td>{{$value->price}}</td>
                                <td>{{$value->payment_status}}</td>
                                <td>{{$value->delivery_status}}</td>

                                <td><img src="{{asset('storage/'.$value->image)}}" alt=""></td>
                                <td>
                                    @if ($value->delivery_status == 'processing')
                                    <a href="{{url('delivery', $value->id)}}"
                                        onclick="return confirm('Are you sure this product is delivered')"
                                        class="btn btn-primary">Delivery</a>
                                    @else
                                    <p>Deliver</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{url('send_email', $value->id)}}" class="btn btn-google">Send Email</a>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
        <!-- End custom js for this page -->
</body>

</html>