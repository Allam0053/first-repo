<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
	public function index(Request $request){
		if ($request->has('cari')) {
			$tasks = Task::where('name','LIKE','%'.$request->cari.'%')->get();		
		}else{
			$tasks = Task::all();
		}
		return view('welcome', compact('tasks'));
	}
    public function store(Request $request){

    	Task::create([
    		'name' => $request->name
    	]);
    	$temp = $request->name;
    	return redirect()->back()->with('sukses', $temp.' berhasil diinput');
    }
    public function edit($id){
    	$task = Task::find($id);
    	return view('edit', compact('task'));
    }
    public function update(Request $request){
    	Task::where('id', $request->id)->update([
    		'name' => $request->name
    	]);
    	return redirect()->route('index')->with('sukses', 'data berhasil diupdate');
    }
    public function delete($id){
    	$task = Task::find($id);
    	$temp = $task->name;
    	$task->delete();
    	return redirect()->route('index')->with('sukses', $temp.' berhasil dihapus');
    }
}
