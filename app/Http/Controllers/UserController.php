<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use function PHPSTORM_META\elementType;

use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
    // protected $redirectT
    // show register form

    public function viewAll() 
    {
        return view('layout');
    }

    public function registerForm() 
    {
        return view('layout');
    }

    public function showPasswordRecovery()
    {
        return view('layout');
    }

    public function showPasswordResetForm($token) 
    {
        return view('layout', ['token' => $token]);

        // return [
        //     'token' => $token
        // ];
    }

    // show the login form
    public function loginForm(Request $request) 
    {
        // UserController::getPath($request->intended());

        // dd($request->session()->all()["url"]["intended"]);

        // dd(str_replace(url('/'),'',$request->session()->all()["url"]["intended"]));


        // if((str_replace(url('/'),'',$request->session()->all()["url"]["intended"])) === "") {
        //     return 0;
        // } else {
        //     return 1;
        // }


        // dd(url('/').'/somethinggggggggggggg');

        // $value = $request->session()->get('email');

        // dd($value);

        // dd(auth()->user());
        // if($request->user()) {
        //     dd($request->user());
        // } else {
        //     dd($request->user());
        //     dd('another failure');
        // }

        // return redirect('/students/create');

        
        // UserController::getPath(str_replace(url('/'),'',$request->session()->all()["url"]["intended"]));
        
        return view('layout');

        // return response(view('layout'))->withHeaders([
        //     'anotherDumbAttempt' => 'please work'
        // ]);

    }

    public function getPath($path) {
        
    }

    // create new user 
    public function store(Request $request) 
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'string', Rule::unique('users', 'email')],
            'password' => [
                'required',
                'confirmed',
                // Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        
        $user = User::create($formFields);

        // //login
        // auth()->login($user);

        $token = $user->createToken('mainToken')->plainTextToken;
        
        $fName = explode(' ', $user->name)[0];

        $message = "Your account has successfully been created. Welcome, $fName!";

        return response([
            'user' => $user,
            'token' => $token,
            'message' => $message
        ], 201);
    }

    // log the user out
    public function logout(Request $request) 
    {
        // auth()->logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // return redirect('/login')->with('message', 'You have been logged out successfully');

        // $user = Auth::user();

        // $user->currentAccessToken()->delete();

        $request->user()->currentAccessToken()->delete();

        return response([
            'loggedOut' => true,
            'message' => 'You have been logged out successfully.'
        ]);
    }

    //log the user in
    public function login(Request $request) 
    {
        $formFields = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required']
        ]);
        
        $user = User::where('email', $formFields['email'])->first();

        if(!$user || !Hash::check($formFields['password'], $user->password)) {
            return response([
                'error' => 'Invalid credentials.'
            ], 401);
        } else {

        }

        // dd($user->email);
        
        $token = $user->createToken('mainToken')->plainTextToken;
        
        $fName = explode(' ', $user->name)[0];

        $message = "Welcome back, $fName!";

        // $request->session()->put('email', $user->email);


        // session(['email' => $user->email]);


        return response([
            'user' => $user,
            'token' => $token,
            'message' => $message
        ]);
    }

    // //log the user in
    // public function authenticate(Request $request) 
    // {
    //     $formFields = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => 'required'
    //     ]);

    //     if(auth()->attempt($formFields)) {
    //         $request->session()->regenerate();

    //         return redirect('/')->with('message', 'You have been logged in successfully');
    //     }

    //     return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    // }

    public function index() 
    {
        return User::all();
    }

    public function verify(Request $request, User $user)
    {
        // $user = User::where('email', $request['email'])->first();

        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'error' => 'Incorrect password entered.'
            ], 401);
        } else {
            return response([
                'canProceed' => true
            ], 200);
        }
    }

    public function changePassword(Request $request, User $user) 
    {
        
        $user = User::find($user->id);
        
        if(!$user || !Hash::check($request['old_password'], $user->password)) {
            return response([
                'error' => 'Incorrect current password.'
            ], 401);
        } else {
            $formFields = $request->validate([
                'password' => [
                    'required',
                    'confirmed', 
                    // Password::min(8)->mixedCase()->numbers()->symbols()
                ]
            ]);

            $formFields['email'] = $user->email;
            $formFields['name'] = $user->name;
            $formFields['role'] = $user->role;
            $formFields['password'] = bcrypt($formFields['password']);

            $user->update($formFields);

            return response([
                'message' => 'Password updated successfully.'
            ], 200);
        }
    }

    public function update(Request $request, User $user) 
    {
        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'error' => 'Incorrect password entered.'
            ], 401);
        } else {
            $formFields = $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', 'string', Rule::unique('users', 'email')->ignore($user->id)], 
                'role' => 'nullable',
            ]);

            $user->update($formFields);

            return response([
                'user' => $user,
                'message' => 'Details successfully updated.'
            ], 200);
        }
    }

    public function forgotPasswordForm(Request $request) 
    {

        // return 'help';
        $request->validate(['email' => 'required|email']);

        // \Mail::send('test', function ($message) {
        //     $message->from('john@johndoe.com', 'John Doe');
        //     $message->sender('john@johndoe.com', 'John Doe');
        //     $message->to('john@johndoe.com', 'John Doe');
        //     $message->cc('john@johndoe.com', 'John Doe');
        //     $message->bcc('john@johndoe.com', 'John Doe');
        //     $message->replyTo('john@johndoe.com', 'John Doe');
        //     $message->subject('Subject');
        //     $message->priority(3);
        //     $message->attach('pathToFile');
        // });
        
        // dd($request['email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
        

        // dd($status);

        return $status === Password::RESET_LINK_SENT
                    ? ['status' => __($status)]
                    : ['email' => __($status)];
    }
}
