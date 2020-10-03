<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\Pay;
use Illuminate\Support\Facades\Mail;


class CartController extends Controller
{
    public function getAddCart($id){
        // dd($id);
        $product = Product::find($id);
        Cart::add(['id' => $id, 'name' => $product->title, 'qty' => 1,'weight' => 1, 'price' => $product->price, 'options' => ['image' => $product->image]]);
        return redirect('/');
    }

    public function getShow(){
        $total = Cart::total();
        $data = Cart::content();
    //    dd($data);
        return view('frontend.pages.cart',['data'=>$data,'total'=>$total]);
    }

    public function getDelete($id){
        Cart::remove($id);
        return back();
    }

    public function getUpdate(Request $request){
        Cart::update($request->rowId,$request->qty);
    }

    public function getCheckout(){
        $data = Cart::content();
        $total = Cart::total();
        return view('frontend.pages.cart-done',['data'=>$data,'total'=>$total]);
    }


    public function postCheckout(Request $request){

        if($request->email){
            $dataMail = [
                'name'=>$request->name,
                'address'=>$request->address,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'total'=>Cart::total(),
                'data'=>Cart::content()
    
            ];
            $email = $request->email;
            Mail::send('frontend.pages.cartdone',$dataMail,function($meg) use ($email){
                $meg->from('truongdv.hqgroup@gmail.com','Hin Shop');
                $meg->to($email)->subject('Leoo Shop');
            });
        }
//        dd($dataMail);
        $pay = new Pay;
        $pay->name = $request->name;
        $pay->address = $request->address;
        $pay->email = $request->email;
        $pay->status = 0;
        $pay->phone = $request->phone;
        $pay->total = str_replace(',', '',Cart::total());
        $pay->save();
        Cart::destroy();

        return redirect('cart/succsess');
    }

    public function getSusscess(){
        return view('frontend.pages.done');
    }
}
