<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.dangky');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formField = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $formField['password'] = bcrypt($formField['password']);

        $user = User::create($formField);

        auth()->login($user);

        return redirect('/')->with('message', 'Đăng ký thành công');
    }

    public function login()
    {
        return view('user.dangnhap');
    }

    public function authenticate(Request $request)
    {
        $formField = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($formField)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Bạn đã đăng nhập');
        }

        return back()->withErrors(['email' => ['Không thể xác thực']])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
