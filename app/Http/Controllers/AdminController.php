<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Models\Product;

use App\Models\Category;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Notification;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request) {
        $data = new category;
        $data->category_name = $request->category;
        $data->save();
        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id) {
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }

    public function view_product()
    {
        $data = category::all();
        return view('admin.product', compact('data'));
    }

    public function add_product(Request $request) {
        $data = new product;

        $data->title = $request->title;
        $data->description = $request->description;
        $data->category = $request->category;
        $data->price = $request->price;
        
        $data->quantity = $request->quantity;
        $data->discount_price = $request->discount_price;

        if ($request->hasFile('image')) {
            $data->image = $request->file('image')->store('logos', 'public');
        }

        $data->save();

        return redirect()->back()->with('message', 'Product created successfully');

    }

    public function show_product()
    {
        $data = product::all();
        return view('admin.show_product', compact('data'));
    }

    public function update_product($id) 
    {
        $data = product::find($id);
        $value = category::all();
        return view('admin.update_product', compact('data', 'value'));
    }

    public function edit_product(Request $request, $id) {
        $data = product::find($id);
        
        $data->title = $request->title;
        $data->description = $request->description;
        $data->category = $request->category;
        $data->price = $request->price;
        
        $data->quantity = $request->quantity;
        $data->discount_price = $request->discount_price;

        if ($request->hasFile('image')) {
            $data->image = $request->file('image')->store('logos', 'public');
        }

        $data->update();
        
        return redirect()->back()->with('message', 'Product updated successfully');
    }

    public function delete_product($id) {
        $data = product::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function order() 
    {
        $order = Order::all();
        return view('admin.order', compact('order'));
    }

    public function delivery($id)
    {
        $order = Order::find($id);
        $order->delivery_status = "delivered";
        $order->payment_status = "paid";

        $order->save();

        return redirect()->back();
    }

    public function send_email($id)
    {
        $order = Order::find($id);
        return view('admin.email_info', compact('order'));
    }

    public function send_user_email(Request $request,$id)
    {
        $order = Order::find($id);
        $details = [
            'greeting' => $request->greeting,
            'firstline' => $request->firstline,
            'body' => $request->body,
            'button' => $request->button,
            'url' => $request->url,
            'lastline' => $request->lastline
        ];

        Notification::send($order, new SendEmailNotification($details));

        return redirect()->back();
    }
}