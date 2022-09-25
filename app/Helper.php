<?php

namespace App;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;

class Helper{

    public static function create_uid(){
        $uuid = Uuid::uuid4();
        return $uuid->toString();
    }

    public static function create_slug($data){
        $dat=Str::slug($data);
        return $dat;
    }

    public static function image_upload($image,$clasor){
//        dd(   $factory = (new Factory));
        $factory = (new Factory)
            ->withServiceAccount(app_path().'/'.env("FIREBASE_CREDENTIALS"));
//        dd($factory);
        $cloudStorage = $factory->createStorage($clasor);
//        dd($cloudStorage);
        $defaultBucket = $cloudStorage->getBucket();
//        dd($defaultBucket);
        $name = (string) Str::uuid().".".$image->getClientOriginalExtension(); // use Illuminate\Support\Str;
//        dd($name);
        $pathName = $image->getPathName();
//        dd($pathName);
        $file = fopen($pathName, 'r');
//        dd($file);
        $object = $defaultBucket->upload($file, [
            'name' => $clasor.'/'.$name,
            'predefinedAcl' => 'publicRead'
        ]);
//        dd($object);
        $image_url = 'https://storage.googleapis.com/'.env('FIREBASE_PROJECT_ID').'.appspot.com/'.$clasor.'/'.$name;
//        dd($image_url);
        return $image_url;
    }

    public static function delete_image($image){

        $factory = (new Factory)
            ->withServiceAccount(app_path().'/'.env("FIREBASE_CREDENTIALS"));
        $explode_image=explode('https://storage.googleapis.com/'.env('FIREBASE_PROJECT_ID').'.appspot.com/',$image)[1];
        $cloudStorage = $factory->createStorage("category");
        if($cloudStorage->getBucket()->object($explode_image)==true && $cloudStorage->getBucket()->object($explode_image)!=null){
            $cloudStorage->getBucket()->object($explode_image)->delete();

        }
        return true;
    }

    public static function strip_tags_with_whitespace($string, $allowable_tags = null)
    {
        $string = str_replace('<', ' <', $string);
        $string = str_replace('&nbsp; ', ' ', $string);
        $string = str_replace('&nbsp;', ' ', $string);
        $string = strip_tags($string, $allowable_tags);
        $string = str_replace('  ', ' ', $string);
        $string = trim($string);

        return $string;
    }
}

