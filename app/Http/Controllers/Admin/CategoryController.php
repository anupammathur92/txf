<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Helper;
use App\Category;
use App\Event;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data["categories"] = Category::orderBy("id","desc")->get();
            return view('admin.category.list_category',$data);
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('admin.category.add_category');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'category_name' => 'required|string|unique:categories',
            'category_image' => 'required|image|dimensions:max_height=100,max_width=100'
        ]);
        try{
            $input = $request->all();
            $category_image = "";

            if($request->hasFile('category_image'))
            {
                $file = $request->file('category_image');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;

                $file->move("public/uploads/category/",$file_name);
                $category_image = "category/".$file_name;
            }

            $category = new Category();
            $category->category_name = $request->category_name;
            $category->category_image = $category_image;
            $category_details = $category->save();

            return redirect('admin/list-category')->with('success','Category Added Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data["category_details"] = Category::where(["id"=>$id])->first();
            return view('admin.category.show_category',$data);            
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data["category_details"] = Category::where(["id"=>$id])->first();
            return view('admin.category.edit_category',$data);            
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $validator = $request->validate([
            'category_name'     => 'required|unique:categories,category_name,'.$request->update_id,
            'category_image'    => 'image|dimensions:max_height=50,max_width=50'
        ]);

        try{

            $event_count = Event::where(["category_id"=>$request->update_id])->count();
            
            if($event_count>0){
                return redirect('admin/list-category')->with('error','Category is assigned to Event.');
            }

            if($request->hasFile('category_image')){

                $file = $request->file('category_image');
                $originalname = $file->getClientOriginalName();
                $file_name = time()."_".$originalname;
                $file->move('public/uploads/category/',$file_name);
                $update_arr["category_image"] = "category/".$file_name;
            }

            $update_arr["category_name"] = $request->category_name;

            $category_details = Category::where(["id"=>$request->update_id])->update($update_arr);
            return redirect('admin/list-category')->with('success','Category Updated Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $event_count = Event::where(["category_id"=>$id])->count();
            
            if($event_count>0){
                return redirect('admin/list-category')->with('error','Category is assigned to Event.');
            }
            Category::where(["id"=>$id])->delete();
            return redirect('admin/list-category')->with('success','Category Deleted Successfully.');
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
    public function update_category_status($id){
        try{
            $category_details = Category::where(["id"=>$id])->first();

            if(!empty($category_details)){

                $event_count = Event::where(["category_id"=>$id])->count();
                if($event_count==0){
                    if($category_details->status==0){
                        $status = 1;
                    }else{
                        $status = 0;
                    }
                    $category_details->status = $status;
                    $category_details->save();
                    return redirect('admin/list-category')->with('success','Category Status Updated Successfully.');
                }else{
                    return redirect('admin/list-category')->with('error','Category is assigned to event.');
                }
            }else{
                return redirect('admin/list-category')->with('error','Invalid Operation.');
            }
        }catch(\Exception $e){
            return redirect()->route('admin.dashboard')->with('error','Something went wrong.');
        }
    }
}
?>