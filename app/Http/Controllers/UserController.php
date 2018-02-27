<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Session;
use Image;
use Illuminate\Support\Facades\File;
use App\User;
use DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

        public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    //
    public function index(){
    	return view('profiles.profile', array('user' => Auth::user()) );
    }

    public function edit()

{

return view('profiles.edit')->with('info', Auth::user()->profile);

}
    public function update(Request $request)

{
  $this->validate($request, [
      'location' => 'required',
      'about' => 'required|max:355',
      'passion' => 'required|max:355'
  ]);

  Auth::user()->profile()->update([
  'location' => $request->location,
  'about' => $request->about,
  'passion' => $request->passion

  ]);

  $user = User::find(Auth::user()->id);

   // Handle the user upload of avatar
   if ($request->hasFile('avatar')) {
       $avatar = $request->file('avatar');
       $filename = time() . '.' . $avatar->getClientOriginalExtension();

       // Delete current image before uploading new image
       if ($user->avatar !== 'man.png' && $user->avatar !== 'woman.png')
 {
           // $file = public_path('uploads/avatars/' . $user->avatar);
           $file = 'uploads/avatars/' . $user->avatar;
           //$destinationPath = 'uploads/' . $id . '/';

           if (File::exists($file)) {
               unlink($file);
           }

       }
       // Image::make($avatar)>resize(300, 300)>save(public_path('uploads/avatars/' . $filename));
       Image::make($avatar)->resize(300, 300)->save('uploads/avatars/' . $filename);
       $user = Auth::user();
       $user->avatar = $filename;
       $user->save();
   }


    return back()->with('msg', 'Profiel is bijgewerkt');



}



    }
