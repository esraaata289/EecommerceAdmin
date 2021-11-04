<?php


use Illuminate\Support\Facades\Config;

    function getLanguage()
    {
       return  \App\Models\Language::active()->selection()->get();
    }
    function get_Default_Language()
    {
        return Config::get('app.locale');
    }
    function uploadImage($folder , $image)
    {
        $image->store('/' , $folder);
        $fileName = $image-> hashName();
        $path = 'images/' . $folder . '/' . $fileName;
        return $path;
    }
    {

    }
