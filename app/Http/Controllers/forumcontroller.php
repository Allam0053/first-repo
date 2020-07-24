<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\forum;
use App\komentar;
use Illuminate\Support\Str;


class forumcontroller extends Controller
{
    //fungsi forum
     public function index(){
    	$forum= forum::orderBy('created_at','desc')->paginate(6);
    	return view('forums',compact(['forum']));
    }

    public function create(Request $request){
    	$forum = forum::create($request->all());
		//$forum->slug = Str::slug('$request->judul', '-');
		forum::where('id', $forum->id)->update([
    		'slug' =>  Str::slug($request->judul, '-')
    	]);
		return redirect()->back()->with('sukses','forum baru telah dibuat');
    }

    public function view($id){
        $forum = forum::find($id);
        $komentar = komentar::where('forum_id', $forum->id)->get();
        return view('forum.view',compact(['forum','komentar']));
    }

    public function edit(Request $request){
        forum::where('id', $request->id)->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);
        return redirect()->back()->with('sukses','forum diperbarui');
    }

    public function search_f(Request $request){
        if($request->has('search') && $request->search!=''){
            return redirect()->route('search_utility',$request->search)->with('ketemu',$request->search);
        }
        return redirect()->route('forum')->with('no_result','tidak ada hasil pencarian');
    }

    public function search_utility(Request $request){
        $forum = forum::where('judul','LIKE','%'.$request->search.'%','OR')
                            ->orWhere('konten','LIKE','%'.$request->search.'%')
                            ->orderBy('created_at','desc')
                            ->paginate(6);
        $komentar_f = komentar::Where('konten','LIKE','%'.$request->search.'%')->get();
        return view('forums',compact(['forum','komentar_f']));
    }


    //fungsi komentar
    public function komentar_create(Request $request){
        $komentar = komentar::create([
            'konten'    => $request->konten,
            'user_id'   => $request->user_id,
            'forum_id'  => $request->forum_id,
            //JIKA PARENT ID TIDAK KOSONG, MAKA AKAN DISIMPAN IDNYA, SELAIN ITU NULL
            'parent'    => $request->parent     != '' ? $request->parent:NULL,
        ]);
        return redirect()->back();
    }

    public function edit_k (Request $request){
        komentar::where('id', $request->id)->update([
            'konten' => $request->konten
        ]);
        return redirect()->back();
    }

    public function delete_k($id){
        $komentar = komentar::find($id);
        $komentar->delete();
        return redirect()->back();
    }
}
