<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; 
use App\Models\OrderItem;
use App\Models\Product;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DB;

class OrderController extends Controller
{
    public function PendingOrder(){
        $orders = Order::where('status','pending')->orderBy('id','DESC')->get();
        return view('admin.order.pending_order',compact('orders'));
    } // End Method  


    public function VendorOrder(){

        $id = Auth::user()->id;
       // $orderitem = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','DESC')->get();
        $orderitem = OrderItem::where('vendor_id',$id)->orderBy('id','DESC')->get();
        return view('vendor.order.pending_order',compact('orderitem'));
    } // End Method  

    public function AdminOrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('admin.order.admin_order_details',compact('order','orderItem'));

    }// End Method 


    public function AdminConfirmedOrder(){
        $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('admin.order.confirmed_order',compact('orders'));
    } // End Method 


 public function AdminProcessingOrder(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('admin.order.processing_order',compact('orders'));
    } // End Method 


    public function AdminDeliveredOrder(){
        $orders = Order::where('status','deliverd')->orderBy('id','DESC')->get();
        return view('admin.order.delivered_order',compact('orders'));
    } // End Method 

    public function PendingToConfirm($order_id){

        
        
        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        );

        return redirect('/admin/confirmed/order')->with($notification); 


    }// End Method

    public function ConfirmToProcess($order_id){
        Order::findOrFail($order_id)->update(['status' => 'processing']);

        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );

        return redirect('/admin/processing/order')->with($notification); 


    }// End Method 


    public function ProcessToDelivered($order_id){

    

        $product = OrderItem::where('order_id', $order_id)->get();

        foreach($product as $item){
             Product::where('id',$item->product_id)
                 ->update([
                    'product_qty' => DB::raw('product_qty-'.$item->qty) 
                 ]);
        }


        Order::findOrFail($order_id)->update(['status' => 'deliverd']);

        $notification = array(
            'message' => 'Order Deliverd Successfully',
            'alert-type' => 'success'
        );

        return redirect('/admin/delivered/order')->with($notification); 


    }// End Method 

    public function ProductStock(){

        $products = Product::latest()->get();
        return view('admin.product.product_stock',compact('products'));

    }// End Method 


    public function AdminInvoiceDownload($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('admin.order.admin_order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }// End Method  


    public function ReturnOrder(Request $request,$order_id){

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1, 
        ]);

        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect('/user/order')->with($notification); 

    }// End Method  


    public function ReturnOrderPage(){
        $orders = Order::where('user_id',Auth::id())->where('return_reason','!=',NULL)->orderBy('id','DESC')->get();
        return view('frontend.userdashboard.return_order_view',compact('orders'));

    }// End Method 

    public function VendorReturnOrder(){

        $id = Auth::user()->id;
        
        $orderitem = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','DESC')->get();
        
        return view('vendor.order.return_order',compact('orderitem'));
 
     } // End Method 

     public function VendorCompleteReturnOrder(){

       $id = Auth::user()->id;
       $orderitem = OrderItem::with('order')->where('vendor_id',$id)->orderBy('id','DESC')->get();
       return view('vendor.order.complete_return_order',compact('orderitem'));

     } // End Method 

     public function VendorOrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('vendor.order.vendor_order_details',compact('order','orderItem'));

     }// End Method 





   

}