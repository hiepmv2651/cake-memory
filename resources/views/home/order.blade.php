<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bulma.min.css">
    @include('home.css2')
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <div style="width: 90%; margin-left: auto; margin-right: auto;">
            <table id="example" class="table is-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order as $value)

                    <tr>
                        <td>{{$value->product_title}}</td>
                        <td>{{$value->quantity}}</td>
                        <td>${{$value->price}}</td>
                        <td>{{$value->payment_status}}</td>
                        <td>{{$value->delivery_status}}</td>
                        <td><img src="{{asset('storage/'.$value->image)}}" height="80px" width="150" alt=""></td>
                        <td>
                            @if ($value->delivery_status == 'processing')
                            <a onclick="return confirm('Are you sure to cancel this')"
                                href="{{url('cancel_order', $value->id)}}" class="btn btn-danger">Cancel Order</a>
                            @else
                            <p style="color: blue">Not Allow</p>
                            @endif
                            <a href="{{url('order_details', $value->id)}}" class="btn btn-danger">Order detail</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" style="text-align:right">Total:</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>


        </div>
        @include('home.footer')
    </div>
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bulma.min.js"></script>
    <script></script>
    <script>
        $(document).ready(function () {
    $('#example').DataTable({
        footerCallback: function (row, data, start, end, display) {
            var api = this.api();
 
            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
            };
 
            // Total over all pages
            total = api
                .column(2)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Total over this page
            pageTotal = api
                .column(2, { page: 'current' })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
 
            // Update footer
            $(api.column(4).footer()).html('$' + pageTotal + ' ( $' + total + ' total)');
        },
    });
});
    </script>
    <!-- jQery -->

    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>

</body>

</html>