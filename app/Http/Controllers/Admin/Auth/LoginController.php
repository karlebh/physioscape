<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;

class LoginController extends Controller
{
  use AuthenticatesUsers, LogsoutGuard {
    LogsoutGuard::logout insteadof AuthenticatesUsers;
  }

  /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
  public $redirectTo = '/control/dashboard';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('admin.guest', ['except' => 'logout']);
  }

  public function showLoginForm()
  {
    return view('admin.auth.login');
  }

  /**
   * Get the guard to be used during authentication.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
    return Auth::guard('admin');
  }
}
