<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\ApiResponse;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

$category=Category::all(['id','name']);
$msg='all cat';
return $this->apiresponse($category,$msg,200);




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $requestData = $request->all();
        $Category = Category::create($requestData);  
        $msg=['this  category  saved '];

        return $this->apiresponse($Category,$msg,200); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
       

           
         $cat= Category::where('id', $id)->update(array(
          'name' => $request['title'],
          
        ));
         $Category= Category::find($id);

      
      $msg=' updated sucssfully';
      return $this->apiresponse($Category,$msg,200);   
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Category= Category::find($id);
        $Category->delete();    
    
        $msg=' deleted sucssfully';
        return $this->apiresponse($Category,$msg,200);    }
}
