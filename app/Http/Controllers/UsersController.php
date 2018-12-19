<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User as User;
use Validator, Hash, Crypt;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $getAllUsers = User::paginate(10);
        return view('users', ["data" => $getAllUsers]);
    }

    public function add(Request $request){
      if( $_POST ){
        // @note Best practices açısından aslında burası store ve messages metodu ile ilerlemeliydi
        $messages = [
            'name.required' => 'Ad Soyad alanı zorunlu, lütfen doldurduğunuzdan emin olunuz.',
            'name.max' => 'Ad Soyad alanı için girelebilir maksimum karakter sayısı 50. Lütfen girdiğiniz değeri kontrol ediniz',
            'email.required' => 'E-mail alanı zorunlu, lütfen doldurduğunuzdan emin olunuz.',
            'email.unique' => 'E-mail alanı sistemde kayıtlı lütfen kontrol ediniz.',
            'email.max' => 'E-mail alanı için girelebilir maksimum karakter sayısı 255. Lütfen girdiğiniz değeri kontrol ediniz',
            'password.required' => 'Şifre alanı zorunlu, lütfen doldurduğunuzdan emin olunuz.',
            'password.max' => 'Şifre alanı için girelebilir maksimum karakter sayısı 255. Lütfen girdiğiniz değeri kontrol ediniz'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|max:255'
          ],
          $messages
        );

        if ($validator->fails()) {
          return redirect(route('users.add'))->withInput()->withErrors($validator);
        }
        else {
          $addUserQuery = User::create([
            "name"      => $request->name,
            "email"     => $request->email,
            "password"  => Hash::make($request->password)
          ]);

          if( $addUserQuery ){
            return redirect(route('users'))->with('success', 'Kullanıcı başarıyla oluşturuldu!');
          }
        }
      }
      else {
        return view('users_add');
      }
    }

    public function edit(Request $request, $id){
      if( $_POST ){
        // @note Best practices açısından aslında burası store ve messages metodu ile ilerlemeliydi
        $messages = [
            'name.required' => 'Ad Soyad alanı zorunlu, lütfen doldurduğunuzdan emin olunuz.',
            'name.max' => 'Ad Soyad alanı için girelebilir maksimum karakter sayısı 50. Lütfen girdiğiniz değeri kontrol ediniz',
            'email.required' => 'E-mail alanı zorunlu, lütfen doldurduğunuzdan emin olunuz.',
            'email.unique' => 'E-mail alanı sistemde kayıtlı lütfen kontrol ediniz.',
            'email.max' => 'E-mail alanı için girelebilir maksimum karakter sayısı 255. Lütfen girdiğiniz değeri kontrol ediniz',
            'password.max' => 'Şifre alanı için girelebilir maksimum karakter sayısı 255. Lütfen girdiğiniz değeri kontrol ediniz'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|max:255|unique:users,email,'.$id.',id',
            'password' => 'max:255'
          ],
          $messages
        );

        if ($validator->fails()) {
          return redirect(route('users.edit', $id))->withInput()->withErrors($validator);
        }
        else {
          $getUser = User::where('id', $id)->first();
          $editUserQuery = User::where('id', $id)->update([
            "name"      => $request->name,
            "email"     => $request->email,
            "password"  => $request->password != '' ? Hash::make($request->password) : $getUser->password
          ]);

          if( $editUserQuery ){
            return redirect(route('users.edit', $id))->with('success', 'Kullanıcı başarıyla güncellendi!');
          }
        }
      }
      else {
        $getUser = User::where('id', $id)->get();
        return view('users_edit', [ "user" => $getUser ]);
      }
    }

    public function delete($id){
      if( is_null($id) != true ){
        $getUser = User::where('id', $id)->delete();
        if( $getUser ){
          return redirect('users')->with('success', 'Kullanıcı başarıyla silindi.');
        }
        else {
          return redirect(route('users'))->with('error', 'Ne yazık ki kullanıcı silinemedi.');
        }
      }
      else {
        return redirect(route('users'))->with('error', 'Ne yazık ki kullanıcı bulunamadı!');
      }
    }
}
