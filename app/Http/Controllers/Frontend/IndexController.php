<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contribute;
use Illuminate\Support\Facades\Mail;    

class IndexController extends Controller
{
    public function getIndex(){
        $category = Category::with(['product'])->inRandomOrder()->get();
        $trend = Product::inRandomOrder()->paginate(5);
        $run = Product::inRandomOrder()->paginate(5);
        $hight = Product::inRandomOrder()->paginate(5);
        return view('frontend.pages.index',compact('category','trend','run','hight'));
    }
    
    public function details($slug){
        $data= Product::where('slug',$slug)->first();
        // dd($data);
        $product = Product::where('slug',$slug)->get();
        foreach($product as $item){
            $id = $item->parent_id;
        }
        $product_item = Product::where('parent_id',$id)->inRandomOrder()->paginate(4);
        // dd($product_item);
        return view('frontend.pages.details',compact('data','product_item'));
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function mailContact(Request $request){
        // dd($request->all());
        if($request->email){
            $dataMail = [
                'name'=>$request->name,
                'email'=>$request->email,
                'content'=>$request->content,
    
            ];
            $email = $request->email;
            Mail::send('frontend.pages.content',$dataMail,function($meg) use ($email){
                $meg->from('truongdv.hqgroup@gmail.com','Hin Shop');
                $meg->to($email)->subject('Hin Shop');
            });
        }

        $contr = new Contribute;
        $contr->name = $request->name;
        $contr->email = $request->email;
        $contr->content = $request->content;
        // dd($contr);
        $contr->save();

        return redirect('lien-he')->with('success','Gửi ý kiến đóng góp thành công !');
    }

}