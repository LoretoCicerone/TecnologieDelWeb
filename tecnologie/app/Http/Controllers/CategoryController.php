<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use function mysql_xdevapi\expression;

class CategoryController extends Controller
{
    public function addCategory(Request $request){
        if(Session::get('adminDetails')['categories_full_access']==0){
            return redirect()->back()->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['meta_title'])){
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = "";
            }
            $category = new Category;
            $category->name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];

            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_cat_image_path = 'images/backend_images/categories/large/'.$filename;
                    $medium_cat_image_path = 'images/backend_images/categories/medium/'.$filename;
                    $small_cat_image_path = 'images/backend_images/categories/small/'.$filename;
                    // Resize Images
                    Image::make($image_tmp)->resize(1468,1465)->save($large_cat_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($medium_cat_image_path);
                    Image::make($image_tmp)->resize(100,100)->save($small_cat_image_path);

                    //Store image name in category table
                    $category->image = $filename;
                }
            }
            $category->url = $data['url'];
            $category->save();
            return redirect('/admin/view-categories')->with('flash_message_success','Category added Successfully!');
        }

        $levels = Category::where(['parent_id'=>0])->get();

        return view('admin.categories.add_category')->with(compact('levels'));
    }

    public function editCategory(Request $request, $id = null){
        if(Session::get('adminDetails')['categories_edit_access']==0){
            return redirect()->back()->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        if($request->isMethod('post')){
            $data = $request->all();

            if($request->hasFile('image')){
                if(empty($data['meta_title'])){
                    $data['meta_title'] = "";
                }
                if(empty($data['meta_description'])){
                    $data['meta_description'] = "";
                }
                if(empty($data['meta_keywords'])){
                    $data['meta_keywords'] = "";
                }
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/categories/large/'.$filename;
                    $medium_image_path = 'images/backend_images/categories/medium/'.$filename;
                    $small_image_path = 'images/backend_images/categories/small/'.$filename;
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

            Category::where(['id'=>$id])->update(['name'=>$data['category_name'],
                'description'=>$data['description'],'url'=>$data['url'], 'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],
                'meta_keywords'=>$data['meta_keywords'],'image'=>$filename]);
            return redirect('/admin/view-categories')->with('flash_message_success','Category updated Successfully!');
        }
        $categoryDetails = Category::where(['id'=>$id])->first();
        $levels = Category::where(['parent_id'=>0])->get();
        return view('admin.categories.edit_category')->with(compact('categoryDetails','levels'));
    }

    public function viewCategories(Request $request, $id = null){
        if(Session::get('adminDetails')['categories_view_access']==0){
            return redirect()->back()->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        $categories = Category::get();
        $categories = json_decode(json_encode($categories));
        return view('admin.categories.view_categories')->with(compact('categories'));
    }

    public function deleteCategory(Request $request, $id = null){
        if(Session::get('adminDetails')['categories_full_access']==0){
            return redirect()->back()->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        if(!empty($id)){
            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Category deleted Successfully!');
        }
    }

    public function deleteCategoryImage(Request $request,$id = null){
        if(Session::get('adminDetails')['categories_full_access']==0){
            return redirect()->back()->with('flash_message_error','Non hai i permessi per accedere a questa sezione');
        }
        Category::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Category Image has been deleted successfully!');
    }
}
