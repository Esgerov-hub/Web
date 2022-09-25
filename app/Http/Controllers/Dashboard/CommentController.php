<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Auth;

class CommentController extends Controller
{

function __construct()
    {
        $this->middleware('permission:comments-view|comments-create|comments-edit|comments-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:comments-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:comments-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:comments-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        try {
            $comments = Comments::orderBy('id','desc')->get();

            return view('dashboard.comments.index',compact('comments'));
        }catch (\Throwable $exception)
        {
            return redirect()->back()->with('errors',$exception->getMessage());
        }
    }
    public function changeStat(Request $request, $id)
    {
//        dd($request->all());
        try {
            Comments::where("id",$id)->update([
                "status"=>!$request->status,
            ]);
            return true;

        } catch (\Exception $e) {
            return false;
        }
    }


    public function show($id)
    {
        try {
            $datas = Comments::with(['users','admin','top'])->find($id);

            $data =
                [
                    'id' => $datas->id,
                    'uid' => $datas->uid,
                    'type' => $datas->type,
                    'subject' => $datas->subject,
                    'content' => $datas->content,
                    'user_id' => $datas->users->name_surname,
                    'admin_id' => $datas->admin->name_surname,
                    'element_id' => $datas->element_id,
                    'top_id' => $datas->top->subject,
                    'rating' => $datas->rating,
                    'global' => $datas->global,
                    'status' => $datas->status,
                    'created_at' => $datas->created_at->format('d.m.Y')
                ];
            return $data;
            return response()->json($data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $user_id = $request->admin_id;

            Comments::where('id', $id)->update(['admin_id' => $user_id,'status' => 1]);

            return redirect()->back()->with('success', 'Məlumat təsdiq edildi!');
        } catch (\Throwable $exception) {
            return redirect()->back()->with('errors', $exception->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
             Comments::where('id',$id)->delete();

            return redirect()->back()->with('success','Məlumatınız ləvğ edildi!');
        }catch (\Throwable $exception)
        {
            return redirect()->back()->with('errors',$exception->getMessage());
        }
    }


    public function recycle()
    {
        try{
            $comments = Comments::orderBy('id','desc')->onlyTrashed()->get();
           
            return view('dashboard.comments.recycle',compact('comments'));

        }catch(\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    public function restore(Comments $comment,$id)
    {
        try {
            $comments = Comments::where('id',$id)->withTrashed()->restore();

            return redirect()->back()->with('success', 'Məlumatınız geri qaytarıldı.');
        }catch (\Throwable $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }
    }  

}
