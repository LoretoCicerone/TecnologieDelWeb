<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Prophecy\Doubler\DoubleInterface;
use Session;
use Image;
use App\Category;
use App\Product;
use App\Coupon;
use DB;
use function mysql_xdevapi\expression;


class ProductsController extends Controller
{
    public function addProduct(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;
            if(empty($data['category_id'])) {
                return redirect()->back()->with('flash_message_error', 'Under Category is missing!');
            }
            $product = new Product();
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_brand = $data['product_brand'];
            if(!empty($data['description'])){
                $product->description = $data['description'];
            }else{
                $product->description = '';
            }
            $product->price = $data['price'];

            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->resize(1468,1465)->save($large_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($medium_image_path);
                    Image::make($image_tmp)->resize(100,100)->save($small_image_path);

                    //Store image name in products table
                    $product->image = $filename;
                }
            }

            $product->stock = $data['stock'];
            $product->save();
            //return redirect()->back()->with('flash_message_success','Product has been added successfully!');
            return redirect('/admin/view-products')->with('flash_message_success','Product has been addedd successfully!');
        }

        //Categories drop down start
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled></option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        //Categories drop down ends
        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    public function editProduct(Request $request, $id = null){

        if($request->isMethod('post')){
            $data = $request->all();

            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($medium_image_path);
                    Image::make($image_tmp)->resize(100,100)->save($small_image_path);
                }
            }else{
                $filename=$data['current_image'];
            }
            if(empty($data['description'])){
                $data['description']='';
            }

            Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_brand'=>$data['product_brand'],'description'=>$data['description'],'price'=>$data['price'],'stock'=>$data['stock'],'image'=>$filename]);
            return redirect('/admin/view-products')->with('flash_message_success','Product has been updates successfully!');
        }

        //Get Product Details
        $productDetails = Product::where(['id'=>$id])->first();
        //Categories drop down start
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled></option>";
        foreach($categories as $cat){
            if($cat->id==$productDetails->category_id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                if($sub_cat->id==$productDetails->category_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value = '".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        //Categories drop down ends
        return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));
    }

    public function viewProducts(Request $request,$id=null){
        $products = Product::orderby('id')->get();
        $products = json_decode(json_encode($products));
        foreach ($products as $key => $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        //echo "<pre>"; print_r($products); die;
        return view('admin.products.view_products')->with(compact('products'));
    }

    public function deleteProduct(Request $request,$id=null){
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product has been deleted successfully!');
    }

    public function deleteProductImage(Request $request,$id = null){

        //Prende il nome dell'immagine del prodotto
        $productImage = Product::where(['id'=>$id])->first();

        //Si trova il path dell'immagine
        $small_image_path = 'images/backend_images/products/small/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $large_image_path = 'images/backend_images/products/large/';


        //Elimina le immagini dal path
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        Product::where(['id'=>$id])->update(['image'=>'']);

        return redirect()->back()->with('flash_message_success','Product Image has been deleted successfully!');
    }

    public function products($url = null){

        //Mostra la pagina 404 se l'url della categoria non esiste
        $countCategory = Category::where(['url'=>$url])->count();
        if($countCategory==0){
            abort(404);
        }

        //Get all categories and subcategories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $categoryDetails = Category::where(['url' => $url])->first();

        if($categoryDetails->parent_id==0){
            //If url is main category url
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
            foreach ($subCategories as $key => $subcat){
                $cat_ids[] = $subcat->id;
            }
            $productsAll = Product::whereIn('category_id', $cat_ids)->get();
            $productsAll = json_decode(json_encode($productsAll));
        }else{
            //If url is sub category url
            $productsAll = Product::where(['category_id' => $categoryDetails->id])->get();
        }

        return view('products.listing')->with(compact('countCategory','categories','categoryDetails','productsAll'));
    }

    public function product($id = null){
        //Get Product Details
        $productDetails = product::where('id',$id)->first();
        $productDetails = json_decode(json_encode($productDetails));

        $relatedProducts = Product::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->get();
        /* $relatedProducts = json_decode(json_encode($relatedProducts));  */

       /* foreach ($relatedProducts->chunk(3) as $chunk){
            foreach ($chunk as $item){
                echo $item; echo "<br>";
            }
            echo "<br><br><br>";
        }
        die;   */

        //Get all categories and subcategories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $total_stock = Product::where('id',$id)->sum('stock');

        return view('products.detail')->with(compact('productDetails','categories','total_stock','relatedProducts'));
    }

    public function addtocart(Request $request){
        $data = $request->all();

        if(empty($data['user_email'])){
            $data['user_email'] ='';
        }

        $session_id = Session::get('session_id');
        if(empty($session_id)) {
            $session_id = str_random(40);
            Session::put('session_id', $session_id);
        }

        $countProducts =  DB::table('cart')->where(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'session_id'=>$session_id])->count();

        if($countProducts>0){
            return redirect()->back()->with('flash_message_error','Il prodotto è già presente nel carrello STRONZO!');
        }else{

            DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'price'=>$data['price'],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
        }

        return redirect('cart')->with('flash_message_success','Product has been added in Cart!');

    }

    public function cart(){
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        foreach ($userCart as $key => $product) {
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        return view('products.cart')->with(compact('userCart'));
    }

    public function deleteCartProduct($id = null){
        Session::forget('CouponAmount');
        Session::forget('couponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_message_success','Il prodotto è stato eliminato dal carrello!');
    }

    public function updateCartQuantity($id=null,$quantity=null){
        Session::forget('CouponAmount');
        Session::forget('couponCode');
        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        $getAttributeStock = Product::where('product_code',$getCartDetails->product_code)->first();
        echo $getAttributeStock->stock; echo "--";
        $updated_quantity = $getCartDetails->quantity+$quantity;
        if($getAttributeStock->stock >= $updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart')->with('flash_message_success','La quantità è stata aggiornata con successo!');
        }else {
            return redirect('cart')->with('flash_message_error', 'La quantità richiesta non è disponibile!');
        }
    }

    public function applyCoupon(Request $request){

        Session::forget('CouponAmount');
        Session::forget('couponCode');

        $data = $request->all();
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0) {
            return redirect()->back()->with('flash_message_error', 'Coupon is not valid');
        }else{
            //Get Coupon Details
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
            //If coupon is inactive
            if($couponDetails->status==0){
                return redirect()->back()->with('flash_message_error', 'Coupon is not valid');
            }
            //If coupon Expired
            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date < $current_date){
                return redirect()->back()->with('flash_message_error', 'Coupon is Expired');
            }

            //Get Cart Total Amount
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
            $total_amount = 0;
            foreach ($userCart as $item){
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            //Check if amount type is Fixed or Percentage
            if($couponDetails->amount_type=="Fixed"){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            //Add Coupon Code & Amount in Session
            Session::put('CouponAmount',$couponAmount);
            Session::put('couponCode',$data['coupon_code']);

            return redirect()->back()->with('flash_message_success', 'Coupon code successfully applied. Tu sei un morto di fame!');

        }
    }

}
