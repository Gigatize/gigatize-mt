<?php

namespace App\Repositories;


use App\Category;
use Illuminate\Support\Facades\Storage;
use Optimus\Genie\Repository;

class CategoryRepository extends Repository
{
    protected function getModel()
    {
        return new Category;
    }

    public function create($request){
        $category = new Category();
        $category->name = $request->get('name');
        $filename = "/categories/".strtolower(str_replace(" ","_",$request->get('name'))).".".$request->file('icon')->getClientOriginalExtension();
        Storage::disk('uploads')->put($filename, $request->file('icon')->getRealPath());
        $category->icon_path = '/images'.$filename;
        $category->save();
        if($category){
            $response = array(
                'success' => true,
                'object' => $category,
            );
            return (object)$response;
        }else{
            $response = array(
                'success' => false,
                'msg' => "Something went wrong",
                'error' => 500
            );
            return (object)$response;
        }

    }
}