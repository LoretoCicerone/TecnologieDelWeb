<?php

namespace App\Http\Controllers;

use App\CmsPage;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function addCmsPage(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $cmspage = new CmsPage;
            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }
            $cmspage->status = $status;
            $cmspage->save();
            return redirect('/admin/view-cms-pages')->with('flash_message_success','CMS Page has been added successfully!');
        }
        return view('admin.pages.add_cms_page');
    }

    public function editCmsPage(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }
            CmsPage::where('id',$id)->update(['title'=>$data['title'],'url'=>$data['url'],'description'=>$data['description'],
                'status'=>$status]);
            return redirect('/admin/view-cms-pages')->with('flash_message_success','CMS Page has been updated successfully!');
        }
        $cmsPage = CmsPage::where('id',$id)->first();
        return view('admin.pages.edit_cms_page')->with(compact('cmsPage'));
    }

    public function viewCmsPages(){
        $cmsPages = CmsPage::get();
        return view('admin.pages.view_cms_pages')->with(compact('cmsPages'));
    }

    public function deleteCmsPage($id){
        CmsPage::where('id',$id)->delete();
        return redirect('/admin/view-cms-pages')->with('flash_message_success','CMS Page has been deleted successfully!');
    }

    public function cmsPage($url){

        //Redirect to 404 if CMS Page is disabled or does not exists
        $cmsPageCount = CmsPage::where(['url'=>$url,'status'=>1])->count();
        if($cmsPageCount>0){
            $cmsPageDetails = CmsPage::where('url',$url)->first();
        }else{
            abort(404);
        }
        return view('pages.cms_page')->with(compact('cmsPageDetails'));
    }

    public function contact(){
        return view('pages.contact');
    }

}
