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
        }

        .input_color {
            color: black;
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
        <div class="main-panel">
            <div class="content-wrapper">

                @if(session()->has('message'))
                <div class="alert alert-success" style="text-align: center" x-data="{show:true}"
                    x-init="setTimeout(() => show=false, 3000)" x-show="show">
                    {{session('message')}}
                </div>
                @endif

                <div class="div_center">
                    <h2 class="h2_font">Add category</h2>

                    <form action="{{url('/add_category')}}" method="POST">
                        @csrf
                        <input type="text" class="input_color" name="category_name"
                            placeholder="Write the category name">
                        <input type="submit" class="btn btn-primary" value="Add Category" name="submit">
                        @error('category_name')
                        <p style="color: red; margin-top: 10px;">{{$message}}</p>
                        @enderror
                    </form>
                </div>
                <br>
                <table id="example" class="table is-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Category Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value)

                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->category_name}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->updated_at}}</td>
                            <td><a onclick="return confirm('Are you sure to delete this')"
                                    href="{{url('delete_category', $value->id)}}" class="btn btn-danger">Delete</a></td>
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