<?php

namespace App\Http\Controllers;

use Stripe;
use Session;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
   
    //TODO: Trang chu
    public function index()
    {
        $product = Product::paginate(6);
        return view('home.userpage', compact('product'));
    }

    //TODO: Trang ca nha
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            $total_products = Product::all()->count();
            $total_orders = Order::all()->count();
            $total_users = User::all()->where('usertype', '=', 0)->count();

            $sum_orders = Order::all()->sum('price');

            $total_devivered = Order::where('delivery_status', '=', 'delivered')->count();

            $total_processing = Order::where('delivery_status', '=', 'processing')->count();

            return view('admin.home', compact('total_products', 'total_users', 'total_orders', 'sum_orders', 'total_devivered', 'total_processing'));
        } else {
            $product = Product::paginate(6);
            return view('home.userpage', compact('product'));
        }
    }

    public function products_detail($id)
    {
        $value = Product::find($id);
        return view('home.products_detail', compact('value'));
    }

    public function add_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userId = $user->id;

            $product = Product::find($id);

            $product_exist_id = Cart::where('Product_id', $id)->where('user_id', $userId)->get('id')->first();

            if ($product_exist_id) {
                $cart = Cart::find($product_exist_id)->first();

                $cart->quantity += $request->quantity;
                if ($product->discount_price !== null)
                    $cart->price = $product->discount_price * $cart->quantity;
                else
                    $cart->price = $product->price * $cart->quantity;
                $cart->save();

                Alert::success('Product added successfully', 'We have added product to cart');

                return redirect()->back();
            } else {
                $cart = new Cart();

                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;

                $cart->product_title = $product->title;

                if ($product->discount_price !== null)
                    $cart->price = $product->discount_price * $request->quantity;
                else
                    $cart->price = $product->price * $request->quantity;

                $cart->image = $product->image;
                $cart->Product_id = $product->id;

                $cart->quantity = $request->quantity;

                $cart->save();

                return redirect()->back();
            }
        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact('cart'));
        } else {
            return redirect('login');
        }
    }

    public function delete_cart($id)
    {
        $data = cart::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function delete_select(Request $request)
    {
        $data = $request->get('ids');

        DB::delete('delete from carts where id in (' . implode(",", $data) . ')');
        return redirect()->back();
    }

    public function cash_order(Request $request)
    {
        $value = $request->get('ids');
        $user = Auth::user();

        $userId = $user->id;
        $data = DB::select('select * from carts where id in (' . implode(",", $value) . ') and user_id = ' . $userId);

        foreach ($data as $data) {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->quantity = $data->quantity;
            $order->product_id = $data->Product_id;

            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';

            $order->save();

            $cartId = $data->id;
            $cart = cart::find($cartId);

            $cart->delete();
        }

        return redirect()->back()->with('message', 'We received your order successfully. We will connect with you soon.');
    }

    public function stripe(Request $request)
    {
        $totalprice = $request->thanhtoan;
        $data = implode(',', $request->get('ids'));
        
        if (Auth::id()) {
            return view('home.stripe', compact('totalprice', 'data'));
        } else {
            return redirect('login');
        }
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment"
        ]);

        $user = Auth::user();

        $userId = $user->id;
        $value = $request->data;
        $data = DB::select('select * from carts where id in (' . $value . ') and user_id = ' . $userId);

        foreach ($data as $data) {
            $order = new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->quantity = $data->quantity;
            $order->product_id = $data->Product_id;

            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';

            $order->save();

            $cartId = $data->id;
            $cart = cart::find($cartId);

            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');

        return view('home.stripe');
    }

    public function show_order()
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userId = $user->id;

            $order = Order::where('user_id', $userId)->latest()->get();
            return view('home.order', compact('order'));
        } else {
            return redirect('login');
        }
    }

    public function order_details($id)
    {
        $value = Order::find($id);
        return view('home.orders_detail', compact('value'));
    }

    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'You cancel the order';
        $order->save();

        return redirect()->back();
    }

    public function product_search(Request $request)
    {
        $search_text = $request->search;
        $product = Product::where('title', 'like', "%$search_text%")
            ->orwhere('category', 'like', "%$search_text%")
            ->paginate(10);
        return view('home.userpage', compact('product'));
    }

    public function product()
    {
        $product = Product::paginate(6);
        return view('home.all_product', compact('product'));
    }

    public function search_product(Request $request)
    {
        $search_text = $request->search;
        $product = Product::where('title', 'like', "%$search_text%")
            ->orwhere('category', 'like', "%$search_text%")
            ->paginate(10);
        return view('home.all_product', compact('product'));
    }
}