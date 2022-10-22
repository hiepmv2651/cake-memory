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

        label {
            display: inline-block;
            width: 200px;
        }

        .div_design {
            padding-bottom: 15px;
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
                <div class="div_center">

                    @if(session()->has('message'))
                    <div class="alert alert-success" style="text-align: center" x-data="{show:true}"
                        x-init="setTimeout(() => show=false, 3000)" x-show="show">
                        {{session('message')}}
                    </div>
                    @endif

                    <h2 class="h2_font">Add product</h2>

                    <form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="div_design">
                            <label>Product title</label>
                            <input class="input_color" type="text" name="title" placeholder="Write the title" required>
                            @error('title')
                            <p style="color: red; margin-top: 10px;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="div_design">
                            <label>Product description:</label>
                            <input class="input_color" type="text" name="description"
                                placeholder="Write the description" required>
                            @error('description')
                            <p style="color: red; margin-top: 10px;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="div_design">
                            <label>Product price:</label>
                            <input class="input_color" type="number" name="price" placeholder="Write the price"
                                required>
                            @error('price')
                            <p style="color: red; margin-top: 10px;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="div_design">
                            <label>Discount price:</label>
                            <input class="input_color" type="number" name="discount_price"
                                placeholder="Write the Discount price">
                            @error('discount_price')
                            <p style="color: red; margin-top: 10px;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="div_design">
                            <label>Product quantity:</label>
                            <input class="input_color" type="number" min="0" name="quantity"
                                placeholder="Write the quantity" required>
                            @error('quantity')
                            <p style="color: red; margin-top: 10px;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="div_design">
                            <label>Product category:</label>
                            <select name="category" class="input_color" required>
                                <option>Add a category here</option>
                                @foreach ($data as $value)
                                <option value="{{$value->category_name}}">
                                    {{$value->category_name}}
                                </option>
                                @endforeach
                            </select>
                            @error('category')
                            <p style="color: red; margin-top: 10px;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="div_design">
                            <label>Product image:</label>
                            <input class="input_color" type="file" name="image" required>
                            @error('image')
                            <p style="color: red; margin-top: 10px;">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="div_design">
                            <input type="submit" value="Add Product" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.js')
        <!-- End custom js for this page -->
</body>

</html>