<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Flysystem\Config;
use PhpParser\Node\Stmt\Return_;

class MainCategoriesController extends Controller
{
    public function index()
    {
         $default_Language = get_Default_Language();
         $categories = MainCategories::where('translation_lang',$default_Language)->selection()->get();
         return view('admin.mainCategories.index' , compact('categories'));
    }

    public function create()
    {
        return view('admin.mainCategories.create');
    }

    public function save(MainCategoryRequest $request)
    {
        try {
            $Main_categories = collect($request->category);
            $filter = $Main_categories->filter(function ($value, $key) {
                return $value['translation_lang'] == get_Default_Language();
            });
            $default_category = array_values($filter->all()) [0];
            $filePath = "";
            if ($request->has('photo')) {
                $filePath = uploadImage('mainCategories', $request->photo);
            }
              DB::beginTransaction();
            $default_category_id = MainCategories::insertGetId([
                'translation_lang' => $default_category['translation_lang'],
                'translation_of' => 0,
                'name' => $default_category['name'],
                'slug' => $default_category['name'],
                'photo' => $filePath,
            ]);

            $categories = $Main_categories->filter(function ($value, $key) {
                return $value['translation_lang'] != get_Default_Language();
            });

            if (isset($categories) && $categories->count() > 0) {
                $categoriesArray = [];
                foreach ($categories as $category) {
                    $categoriesArray[] = [
                        'translation_lang' => $category['translation_lang'],
                        'translation_of' => $default_category_id,
                        'name' => $category['name'],
                        'slug' => $category['name'],
                        'photo' => $filePath,
                    ];
                }
                MainCategories::insert($categoriesArray);
            }
            DB::commit();
            return redirect()-> route('admin.mainCategories')->with(['success' => 'Success to add!']);
        }
        catch (\Exception $ex)
        {
            DB::rollBack();
            return redirect()-> route('admin.mainCategories')->with(['error' => 'Failed to add!']);
        }
    }

    public function edit($MainCategory_Id)
    {
        $mainCategory =  MainCategories::with('categories')
           ->selection()
           -> find($MainCategory_Id);
       if (!$mainCategory)
       {
           return redirect() -> route('admin.mainCategories') ->with(['error' => 'This Main category not found']);
       }
       else{
             return view('admin.mainCategories.edit' , compact('mainCategory'));
       }

    }

    public function update(MainCategoryRequest  $request , $MainCategory_Id )
    {
        try {
            $MainCategory = MainCategories::find($MainCategory_Id);
            if (!$MainCategory)
            {
                return redirect()->route('admin.mainCategories')->with(['error' => 'This Main category not found']);
            }
            else {
                $category = array_values($request->category)[0];

                ////////////////////////////////////////////////////////update active
                if (!$request->has('category.0.active')) {
                    $request->request->add(['active' => 0]);
                }
                else{
                    $request->request->add(['active' => 1]);
                }

                ///////////////////////////////////////////////// update method
                MainCategories::where('id', $MainCategory_Id)
                    ->update([
                        'name' => $category['name'],
                        'active' => $request->active,
                    ]);

                ////////////////////////////////////////////////update image

                if ($request->has('photo')) {
                    $filePath = uploadImage('mainCategories', $request->photo);
                    MainCategories::where('id', $MainCategory_Id)
                        ->update([
                            'photo' => $filePath,
                        ]);
                }
                //////////////////////////////////////////////////////
                return redirect()->route('admin.mainCategories')->with(['success' => 'Success to update']);

            }
        }
        catch (\Exception $ex)
        {
            return redirect()-> route('admin.mainCategories')->with(['error' => 'Failed to add!']);
        }
    }

    public function delete($id)
    {
        try
        {
            $MainCategory = MainCategories::find($id);
            if(!$MainCategory)
                return redirect() -> route('admin.mainCategories') ->with(['error' => 'This category not found']);

             $vendors = $MainCategory->vendors()->count();
            if(isset($vendors) && $vendors !=0)
                {
                    return redirect() -> route('admin.mainCategories') ->with(['error' => 'Can not delete this category']);
                }

            $image = Str::after($MainCategory -> photo , 'assets/'); //to delete the image from it's folder from project
             $image = base_path('assets/'.$image);
            unlink($image);

            $MainCategory->categories()->delete(); //delete all translations of this category
            MainCategories::where('id' , $id) ->delete();
            return redirect() -> route('admin.mainCategories') ->with(['success' => 'Success to delete']);
        }
        catch (\Exception $exception)
        {
         //  return $exception;
            return redirect() -> route('admin.mainCategories') ->with(['error' => 'Error to delete']);
        }
    }

    public function changeStatus($id)
    {
        try
        {
            $MainCategory = MainCategories::find($id);
            if(!$MainCategory)
                return redirect()-> route('admin.mainCategories')->with(['error' => 'This Category not found']);

             $status = $MainCategory->active == 1 ? 0 : 1;
            $MainCategory->update(['active'=>$status]);
            return redirect()-> route('admin.mainCategories')->with(['success' => 'Success to change status of this category']);



        }
        catch (\Exception $exception)
        {
            return redirect()-> route('admin.mainCategories')->with(['error' => 'Failed to Change Status!']);

        }
    }

}
