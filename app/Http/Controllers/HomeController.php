<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Carbon\Carbon;
use Hash;
use DataTables;


class HomeController extends Controller
{
/* Users Details */
	public function index(Request $request){
		if ($request->ajax()) {
		$data = User::latest()->get();
		return Datatables::of($data)
		->addIndexColumn()

		->addColumn('action', function ($row) {
        $btn = '<a href="edit/'.$row->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:;" id="delete_'.$row->id.'" data-id='.$row->id.' class="delete_user delete btn btn-danger btn-sm">Delete</a>';
        return $btn;
        })
		
		->rawColumns(['action'])
		->make(true);
		}
		return view('welcome');
	}

/*Calling Register Form*/
	public function register(){
		$user = new User;
	    return view('insert', compact('user'));
	}

/*Insert/Update Users*/
	public function RegisterUser(Request $request){
		$rules = [
				'name' => 'required|string|min:3|max:255',
				'email' => 'required|unique:users,email,'.$request->id,




				'password' => 'min:6|max:30|required_with:confirm_password|same:confirm_password',
				'confirm_password' => 'min:6'
		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect::back()
			->withInput()
			->withErrors($validator);
		}

		if($request->id){
			$student = User::find($request->id);
			$student->name = $request->name;
			$student->email = $request->email;
			$user_id=$request->id;
			$student->push();
			$message = 'User Updated Successfully';
		}
		else{

			$student = new User;
			$student->password =Hash::make($request->password);
			$student->name = $request->name;
			$student->email = $request->email;
			$student->save();
			$user_id=$student->id;
			$profile = new Profile;
			$profile->user_id = $user_id;
			$profile->save();
			$message = 'User Created Successfully';
		}
				
		if($request->has('image')) 
		{ 
			$file = $request->file('image');
			$extension = $file->getClientOriginalExtension();
			$filename =time().'.'.$extension;

			$file->move(public_path('uploads'), $filename);

			$student->profile->image = $filename;
			$student->push();
		}

		return redirect('/')->with('status', $message);	
	}
	public function EditUser($id){ 

		$user =User::where('id',$id)->first();
		if($user){
			$user = User::find($id);
	    	return view('insert', compact('user'));
		}
		else{
			return redirect::back()->with('error','Invalid ID');
		}
	}   

/*Delete User*/
	public function DeleteUser($id){ 
		$user = User::where('id',$id);
		if ($user) {
			$user->delete();
			$msg='User deleted Successfully!';
			$res='true';
		}
		else{
			$msg='Invalid User ID!';
			$res='error';
		}
		return response(array('success'=>$res,'msg'=>$msg));
	}   
}
