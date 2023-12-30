<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;




class UserController extends Controller
{
    public function UserDashboard(){
        $id = Auth::user()->id;
        $user_data = User::find($id);
        $orders = Order::where('user_id',$id)->orderBy('id','DESC')->get();
        return view('dashboard', compact('user_data', 'orders'));
    }

    public function UserDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }  

    public function UserProfileStore(Request $request){
        $id = Auth::user()->id;
        $user_data = User::find($id);

        $user_data->name = $request->name;
        $user_data->email = $request->email;
        $user_data->phone = $request->phone;
        $user_data->address = $request->address;
        
        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('AdminBackend/upload/user_image/'.$user_data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('AdminBackend/upload/user_image/'),$filename);
            $user_data['photo'] = $filename;
        }

        $user_data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }   

    public function UserUpdatePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with('error', "Old Password Doesn't Match");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);

    }  

    public function Dashboard(){
        $user_id = Auth::id();
        $user_data = User::where('id', $user_id)->first();
        return view('frontend.userdashboard.dashboard', compact('user_data'));

    }

    public function Order(){
        $user_id = Auth::id();
        $orders = Order::where('user_id',$user_id)->orderBy('id', 'DESC')->get();
        return view('frontend.userdashboard.order', compact('orders'));
    }

    public function UserAccountDetails(){

        $user_id = Auth::id();
        $user_data = User::where('id', $user_id)->first();
        return view('frontend.userdashboard.account_details', compact('user_data'));

    }

    public function UserPasswordSettings(){
        return view('frontend.userdashboard.password_setting');

    }

    public function OrderViewDetail($order_id){
        $order = Order::where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('frontend.userdashboard.order_details',compact('order','orderItem'));

    }

    public function UserOrderInvoice($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('frontend.userdashboard.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }// End Method 

    public function UserTrackOrder(){
        return view('frontend.userdashboard.user_track_order');
    }// End Method 

    public function OrderTracking(Request $request){

        $invoice = $request->code;

        $track = Order::where('invoice_no',$invoice)->first();

        if ($track) {
           return view('frontend.userdashboard.track_order',compact('track'));

        } else{

            $notification = array(
            'message' => 'Invoice Code Is Invalid',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification); 

        }

    }// End Method 

   

}
