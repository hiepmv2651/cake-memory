<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
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
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                <div class="alert alert-success" style="text-align: center" x-data="{show:true}"
                    x-init="setTimeout(() => show=false, 3000)" x-show="show">
                    {{session('message')}}
                </div>
                @endif

                <h2 class="h2_font">Show Product</h2>

                <table id="example" class="table is-striped" style="width:100%" style="background-color: white">
                    <thead>
                        <tr>

                            {{-- <th>Id</th> --}}
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            {{-- <th>Discount price</th>
                            <th>Quantity</th> --}}
                            {{-- <th>Category</th>
                            <th>Image</th> --}}
                            {{-- <th>Created At</th>
                            <th>Updated At</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value)

                        <tr>
                            {{-- <td>{{$value->id}}</td> --}}
                            <td>{{$value->title}}</td>
                            <td>{{$value->description}}</td>
                            <td>{{$value->price}}</td>
                            {{-- <td>{{$value->discount_price}}</td>
                            <td>{{$value->quantity}}</td> --}}
                            {{-- <td>{{$value->category}}</td>
                            <td><img src="{{asset('storage/'.$value->image)}}" alt=""></td> --}}
                            {{-- <td>{{$value->created_at}}</td>
                            <td>{{$value->updated_at}}</td> --}}
                            <td>
                                <a href="{{url('update_product', $value->id)}}" class="btn btn-inverse-warning">Edit</a>
                                <a onclick="return confirm('Are you sure to delete this')"
                                    href="{{url('delete_product', $value->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
        <!-- End custom js for this page -->
</body>

</html>