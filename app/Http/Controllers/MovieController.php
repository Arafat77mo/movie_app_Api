<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Traits\GeneralTrait;
use App\Http\Controllers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{ use GeneralTrait;
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

if($request->q){

            $result  = Movie::where("title" , "like","%$request->q%")
            ->orWhere("rate" , "like" ,"%$request->q%")->join('categories','movies.category_id','=','categories.id')
            ->orWhere("categories.name" , "like" ,"%$request->q%")
            ->orderBy("id","DESC")
            ->get();
            if(count($result)){
                $msg='all movies';

                return $this->apiresponse($result,$msg,200); 
            }else{
                return response()->json(["result" => "this movie not Found"],404);
            }
      }else{ $result= DB::table('movies')->join('categories','movies.category_id','=','categories.id')
        ->select('movies.id','movies.title','movies.description','movies.rate','movies.image','categories.name')
       ->get();
       $msg='all movies';
        return $this->apiresponse($result,$msg,200);
      }
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
     * @param  \App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {

        if($request->hasfile("image")){
           
            $image= $request->image;
         $imageName=time().'.'.$image->getClientOriginalExtension();
         $request->image->move('public', $imageName);
        }
        $requestData = $request->all();
        $requestData['image'] =$imageName;
        $movie = Movie::create($requestData);   
        $msg=['this  movie  saved '];
        return $this->apiresponse($movie,$msg,200); 
       }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request ,$id)
    {
        $movie=Movie::find($id);

        if($request['image']){ 
            $data=$request->all();
            $image= $request->image;
         $imageName=time().'.'.$image->getClientOriginalExtension();
         $request->image->move('public', $imageName);
               $data['image'] =$imageName;
       
               $movie->update($data);
       
       }else{
           
         $movie= Movie::where('id', $id)->update(array(
          'title' => $request['title'],
          'description'=> $request['description'],
          'rate'=> $request['rate'],
          'category_id'=> $request['category_id']
        ));
              
      }
      $msg=' updated sucssfully';
      return $this->apiresponse($movie,$msg,200); 

   }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie= Movie::find($id);
        $movie->delete();    
    
        $msg=' deleted sucssfully';
        return $this->apiresponse($movie,$msg,200);
    
    }
}
