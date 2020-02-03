<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;
use App\User;
use Auth;
use Image;
use File;

class ListController extends Controller
{
    public function show(Request $request)
    {
       return view('welcome');
    }

    public function uploadImage(Request $request){
        
        if (!empty($request->file('edit_cover_image'))) {

            $id = 2;
            $ext = $request->file('edit_cover_image')->getClientOriginalExtension();
            $image = Image::make($request->file('edit_cover_image'));

            $image = $image->resize(null,500,function($constraint){
                    $constraint->aspectRatio();
                    $constraint->upsize();
            });

            $fileName = rand(10000,100000).'_'.date('YmdHi').'.'.$ext;
            $folder = public_path('frontend/images/users/'.$id);

            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0775, true, true);
            }

            $image = $image->save($folder.'/'.$fileName);

        }
    }

    public function login(Request $request){
        if ($request->isMethod('post')) {

            $user   = User::where('email',$request->email)->first();
            $request->validate([
                'email'    => 'required|max:50',
                'password' => 'required|max:20',
            ]);

            if (isset($user) && !empty($user->email)) {
                $userData['email']    = $request->email;
                $userData['password'] = $request->password;
                $userData['verified_email'] = 'yes';

                if (Auth::guard('web')->attempt($userData)) {
                    return redirect('/create-project')->with('success','Login successful.');  
                } else {
                    return redirect('/register')->with('error','Password does not match.');
                }

            } else {

                session::flash('error','Email-id not registered.');
                return redirect('/login');

            }
        }
        return view('login');
    }

    public function register(Request $request){

        if ($request->isMethod('post')) {
            $validatedData  = $request->validate([
                'first_name' => 'required|max:50',
                'last_name'  => 'required|max:50',
                'email'    => 'required|unique:users|max:50',
                'password' => 'required|max:20',
            ]);

            $token_str = 'dfbg2j2g5hjsajs345435nfdjsf4nf8i7asjdkda3445jdfjkdfu3dd4sfd5fd5sfs243343x43g645645bwp4sdkj45fh645y8514y454b463553jm24c4423sdfery';
            $data = $request->input();
            $user = new User;
            $user->first_name = $data['first_name'];
            $user->last_name  = $data['last_name'];
            $user->email      = $data['email'];
            $user->verified_email = 'no';
            $user->email_verify_token = substr(str_shuffle($token_str), 0, 8);
            $user->password   = Hash::make($data['password']);
            $user->save();

            Mail::send('frontend.email.verify_email', ['user' => $user], function($message) use ($user){
                $message->to($user['email'])->subject('Jiradi verification email');
            });

            session::flash('success','Verify email to complete your profile');
            return redirect()->back()->with('success','updated');
        }

        return view('register');
    }

    public function verifyEmail(Request $request,$user_id=null,$token=null){

        $id     = base64_decode($user_id);
        $token  = base64_decode($token);
        $user   = User::where(['id'=>$id])->first();

        if ($user && !empty($user->id)) {
            if ($token == $user->email_verify_token) {
                $update = User::where([
                                'id'=>$id, 'email_verify_token'=>$token
                            ])->update([
                                'verified_email' => 'yes',
                                'email_verify_token' => ''
                            ]);
                return redirect('/?verify=login');
            } else {
                return redirect('/')->with('error','This link has been expired');
            }
        } else {
            return redirect('/')->with('error','User not found');
        }
    }

    public function forgotPassword(){
       return view('forgot_password');
    }

    /*************** Send link on email at time of reset password *****************/ 

    public function sendLink(Request $request)
    {
        $data   = $request->input();
        $exist  = User::where('email',$data['email'])->first();
        if (!empty($exist)) {

            $rand_number    = rand(10,10000);
            $rand           = \Crypt::encrypt($rand_number);
            $id             = $exist->id;
            $id             = \Crypt::encrypt($id);
            $email          = $exist->email;
            User::where('id',$exist->id)->update(['forgot_password_key'=>$rand]);
            $url    = url('/user-reset-password-link');        
            $link   =   $url .'/'. $rand . '/' . $id;
            $links  = array();
            $links['link'] = $link;
            $links['name'] = $exist->first_name.' '.$exist->last_name;
            $subject = "Reset Password Link Jiradi.";
            Mail::send('frontend.email.forgot_password', $links, function($message) use ($email,$subject){
                $message->to($email)->subject($subject);
            });
            return redirect('/user-forgot-password')->with('success','Reset link has been sent on to your email.');
        } else {

            return redirect('/user-forgot-password')->with('error','Wrong Email Id! Please enter correct email.');
        }
    }

    /*************** Confirmation on click reset password *****************/ 

    public function confirmationMessage($key = null , $id = null)
    {
        $id         = \Crypt::decrypt($id);
        $user_data  = User::where('id',$id)->value('forgot_password_key');
        // dd($user_data);
        User::where('id',$id)->update(['forgot_password_key'=>""]);
        $user_id    = \Crypt::encrypt($id);
        if ($user_data == $key) {
            return view('reset_password')->with('id',$id);
        } else {
            return redirect('/')->with('error','Your link has been expired.');
        }
    }

    /*************** Upadate new password at reset password page *****************/ 
    public function resetPassword(Request $request)
    {
        $data       = $request->input();        
        $password   = Hash::make($data['new_password']);
        User::where('id',$data['id'])->update(['password'=>$password]);
        return redirect('/login')->with('success','Password has been reset. Login to your account.');
    }

    public function createProject(Request $request){
        if ($request->isMethod('post')) {
        }
        return view('frontend.project.create-project');
    }

    public function gallery(Request $request){
        $user = '';
        Mail::send('frontend.email.test', ['user' => $user], function($message) use ($user){
                    $message->to('neha@mailinator.com')->subject('TBYB verification email');
                });
        
    }

    public function checkUserEmail(Request $request)
    {
        $user_email =  User::where(['email'=>$request['email']])->first();
        if(!empty($user_email)){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success','Logout successful.');
    }
}
