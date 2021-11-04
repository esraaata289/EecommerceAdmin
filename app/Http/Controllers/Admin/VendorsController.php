<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\MainCategories;
use App\Models\Vendor;
use App\Notifications\VendorCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;


class VendorsController extends Controller
{
    public function index()
    {
       $vendors =  Vendor::selection()->paginate(PAGINATION_COUNT);
       return view('admin.vendors.index' , compact('vendors'));
    }
    //////////////////////////////////////////////
    public function create()
    {
        $Categories = MainCategories::where('translation_lang' , get_Default_Language()) -> Active() -> get();
        return view('admin.vendors.create' , compact('Categories'));

    }
    public function save(VendorRequest $request)
    {
        try {

            ////////////////////////////////////////////////////////update active
            if (!$request->has('active')) {
                $request->request->add(['active' => 0]);
            }
            else{
                $request->request->add(['active' => 1]);
            }
            /////////////////////////////////////////////////////////////////// save logo
            $filePath = "";
            if ($request->has('logo')) {
                $filePath = uploadImage('vendors', $request->logo);
            }
            ///////////////////////////////////////////////////////////////////

             $vendor = Vendor::create([
                    'name' => $request->name,
                    'mobile' => $request->mobile,
                    'email' => $request->email,
                    'password' => $request->password,
                    'active' => $request->active,
                    'address' => $request->address,
                    'category_id' => $request->category_id,
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                    'logo' => $filePath
            ]);
              // Notification::send($vendor , new VendorCreated($vendor));

               return redirect() -> route('admin.vendors') -> with(['success' => 'Succeed to add ']);

        }
        catch (\Exception $exception)
        {
            return $exception;
            return redirect() -> route('admin.vendors') -> with(['error' => 'Failed to add ']);

        }
    }
    /////////////////////////////////////////////
    public function edit($id)
    {
        try
        {
            $vendor = Vendor::selection()->find($id);
            if(!$vendor)
            {
                return redirect() -> route('admin.vendors') -> with(['error' => 'This vendor not found']);
            }
            else{
                $Categories = MainCategories::where('translation_lang' , get_Default_Language()) -> Active() -> get();
                return view('admin.vendors.edit' , compact('vendor' , 'Categories'));
            }
        }
        catch (\Exception $exception)
        {
            return redirect() -> route('admin.vendors') -> with(['error' => 'Failed to edit']);
        }
    }
    ///////////////////////////////////////////////////
    public function update($id , VendorRequest $request)
    {
        try
        {
            $vendor = Vendor::selection()->find($id);
            if(!$vendor)
            {
                return redirect() -> route('admin.vendors') -> with(['error' => 'This vendor not found']);
            }
            else
            {
                DB::beginTransaction();
                ////////////////////////////////////////////////update image// when the image will update it will enter if loop
                if ($request->has('logo') ) {
                    $filePath = uploadImage('vendors', $request->logo);
                    Vendor::where('id', $id)
                        ->update([
                            'logo' => $filePath,
                        ]);
                }
                //////////////////////////////////////////////////////////////update active
                if (!$request->has('active'))
                    $request->request->add(['active' => 0]);
                else
                    $request->request->add(['active' => 1]);
                ////////////////////////////////////////////////update password //when the password will update it will enter if loop

                $data = $request -> except('_token','id','logo','password');

                if ($request->has('password') && !is_null($request->  password)) {
                    $data['password'] = $request-> password;
                }
                Vendor::where('id' , $id) -> update($data);
            }
            DB::commit();
            return redirect() -> route('admin.vendors') -> with(['success' => 'success to edit ']);

        }
        catch (\Exception $exception)
        {
            return $exception;
            DB::rollBack();
            return redirect() -> route('admin.vendors') -> with(['error' => 'Failed to edit ']);


        }
    }
    ///////////////////////////////////
    public function delete($id)
    {
        try
        {
          $vendor = Vendor::find($id);
          if(!$vendor)
            return redirect() -> route('admin.vendors') -> with(['error' => 'This vendor not found']);


            $image = Str::after($vendor -> logo , 'assets/'); //to delete the image from it's folder from project
            $image = base_path('assets/'.$image);
            unlink($image);

            Vendor::where('id' , $id) ->delete();
            return redirect() -> route('admin.vendors') ->with(['success' => 'Success to delete']);
        }
        catch (\Exception $exception)
        {
            return redirect() -> route('admin.vendors') -> with(['error' => 'Failed to delete']);
        }
    }
    ////////////////////////////////////////////////
    public function changeStatus($id)
    {
        try
        {
           $vendor = Vendor::find($id);
           if(!$vendor)
               return redirect() -> route('admin.vendors') -> with(['error' => 'This vendor not found']);

          $status = $vendor -> active == 1 ? 0 : 1;
          $vendor -> update(['active' => $status]);
            return redirect() -> route('admin.vendors') -> with(['success' => 'Success to change status']);


        }
        catch (\Exception $exception)
        {
            return redirect() -> route('admin.vendors') -> with(['error' => 'Failed to change status']);
        }
    }
}
