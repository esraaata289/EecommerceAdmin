<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Languagerequest;
use App\Models\Language;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class languagesController extends Controller
{
    public function index()
    {
        $languages = Language::selection()->paginate(PAGINATION_COUNT);
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function save(Languagerequest $request)
    {
        try {
//            if(!$request ->has('active'))
//            {
//                $request->request->add(['active' => 0]);
//            }
            Language::create($request->except(['_token']));
            return redirect()->route('admin.languages')->with(['success' => 'Added Successfully']);
        } catch (Exception $ex) {
            return redirect()->route('admin.languages')->with(['error' => 'There is an error , Try again!']);
        }
    }

    public function edit($id)
    {
        $language = Language::select()->find($id);
        if (!$language) {
            return redirect()->route('admin.languages')->with(['error' => 'This is language not found!']);
        }
        return view('admin.languages.edit', compact('language'));

    }

    public function update($id, Languagerequest $request)
    {
          try {
                    // Update table recored
                  $language = Language::where('id', $id);
                  if(!$request ->has('active'))
                  {
                      $request->request->add(['active' => 0]);
                  }
                  $language ->update($request->except('_token'));

                    return redirect()->route('admin.languages')->with(['success' => 'edit done Successfully']);
          }
          catch (Exception $exception) {
              return redirect()->route('admin.languages')->with(['error' => 'There is an error , Try again!']);

          }


    }

    public function delete($id)
    {
        try {
            $language = Language::where('id',$id)->delete();

            return redirect()->route('admin.languages')->with(['success' => 'delete done Successfully']);

        } catch (Exception $exception) {
            return redirect()->route('admin.languages')->with(['error' => 'There is an error , Try again!']);

        }


    }
}




