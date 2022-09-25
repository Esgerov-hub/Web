<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CKMEDIAUP;
use Illuminate\Http\Request;

class CommonControllers extends Controller
{
    public function ckEditorUpload(Request $request)
    {
        try {
            $task = new CKMEDIAUP();
            $task->id = 0;
            $task->exists = true;
            $image = $task->addMedia($request->file("upload"))->toMediaCollection('images', 'uploads');
dd($task);
            return response([
                "url" => $image->getUrl('thumb')
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function notfound(){
        try{
            return view('layouts.404');
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
