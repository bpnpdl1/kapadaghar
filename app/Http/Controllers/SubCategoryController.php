<?php

namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use App\Models\SubCategory;
    
    class SubCategoryController extends Controller
    {
        public function index()
        {
            $subcategories = Subcategory::all();
            return view('subcategory.index',compact('subcategories'));
        }
       
        public function create()
    {
        $subcategories = SubCategory::all();
        return view('subcategory.create',compact('subcategories'));
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'priority' => 'required|numeric'
        ]);
        SubCategory::create($data);
        return redirect(route('subcategory.index'))->with ('success','SubCategory created successfully');
    }
    public function edit($id)
    {
        $subcategory = SubCategory::find($id);
        return view('subcategory.edit',compact('subcategory'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name'=> 'required',
            'priority'=> 'required|numeric'
        
        ]);
        $subcategory=SubCategory::find($id);
        $subcategory->update($data);
        return redirect(route('subcategory.index'))->with('success','SubCategory updated successfully');
        

    }

       
    //public function destroy($id)
    // public function destroy($id)
    // {
      //  $category = Category::find($id);
      //  $category->delete();
       // return redirect(route('category.index'));
        

   // }

   public function destroy(Request $request)
   {
    $subcategory = SubCategory::find($request->dataid);
    $subcategory->delete();
    return redirect(route('subcategory.index'))->with('success','SubCategory deleted succesfully');
   }
   }


    
    
    

