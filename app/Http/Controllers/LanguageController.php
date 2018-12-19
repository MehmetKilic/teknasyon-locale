<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project as Projects;
use App\Languages as Languages;
use Validator, DB;

class LanguageController extends Controller
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
    public function index($id)
    {
        $getLanguages = Languages::where('project_id', $id)
          ->leftJoin('projects', 'languages.project_id', '=', 'projects.id')
          ->select(DB::raw('projects.id as project_id, project_name, languages.id as id, languages.project_id, languages.language_code, languages.version, languages.key, languages.value, languages.status'))
          ->paginate(20);
        return view('languages', ["languages" => $getLanguages, "id" => $id]);
    }

    public function add(Request $request, $id){
      if( $_POST ){
        // @note Best practices açısından aslında burası store ve messages metodu ile ilerlemeliydi
        $messages = [
            'language_code.required' => 'Dil seçimi zorunludur, lütfen bir dil seçiniz!',
            'version.required' => 'Versiyon alanı zorunludur, lütfen bir versiyon bilgisi giriniz!',
            'key.required' => 'Anahtar Değer alanı zorunludur, lütfen bir anahtar değer bilgisi giriniz!',
            'value.required' => 'Çeviri alanı zorunludur, lütfen bir çeviri bilgisi giriniz!',
            'version.max' => 'Versiyon alanı için girelebilir maksimum karakter sayısı 10. Lütfen girdiğiniz değeri kontrol ediniz',
            'key.max' => 'Proje adı alanı için girelebilir maksimum karakter sayısı 255. Lütfen girdiğiniz değeri kontrol ediniz',
        ];

        $validator = Validator::make($request->all(), [
            'language_code' => 'required',
            'version' => 'required|max:10',
            'key' => 'required|max:255',
            'value' => 'required'
          ],
          $messages
        );

        if ($validator->fails()) {
          return redirect(route('languages.add', $id))->withInput()->withErrors($validator);
        }
        else {
          $getVersionControl = Languages::where('language_code', $request->language_code)
            ->where('key', $request->key)
            ->where('version', $request->version)->count();

          if( $getVersionControl > 1 ){
            return redirect(route('languages', $id))->with('error', 'HATA : Varolan projede aynı aynı dilde ve de aynı versiyon da bir çeviri eklemeye çalışıyorsunuz!');
          }
          $addLanguageQuery = Languages::create([
            "project_id"        => $id,
            "language_code"     => $request->language_code,
            "version"           => $request->version,
            "key"               => $request->key,
            "value"             => $request->value
          ]);

          if( $addLanguageQuery ){
            return redirect(route('languages', $id))->with('success', 'Çeviri başarıyla eklendi!');
          }
        }
      }
      else {
        $getLanguages = Projects::where('id', $id)->first();
        return view('languages_add', ["languages" => $getLanguages]);
      }
    }

    public function edit(Request $request, $id){
      if( $_POST ){
        $messages = [
            'language_code.required' => 'Dil seçimi zorunludur, lütfen bir dil seçiniz!',
            'version.required' => 'Versiyon alanı zorunludur, lütfen bir versiyon bilgisi giriniz!',
            'key.required' => 'Anahtar Değer alanı zorunludur, lütfen bir anahtar değer bilgisi giriniz!',
            'value.required' => 'Çeviri alanı zorunludur, lütfen bir çeviri bilgisi giriniz!',
            'version.max' => 'Versiyon alanı için girelebilir maksimum karakter sayısı 10. Lütfen girdiğiniz değeri kontrol ediniz',
            'key.max' => 'Proje adı alanı için girelebilir maksimum karakter sayısı 255. Lütfen girdiğiniz değeri kontrol ediniz',
        ];

        $validator = Validator::make($request->all(), [
            'language_code' => 'required',
            'version' => 'required|max:10',
            'key' => 'required|max:255',
            'value' => 'required'
          ],
          $messages
        );

        if ($validator->fails()) {
          return redirect(route('languages.edit', $id))->withInput()->withErrors($validator);
        }
        else {
          $getVersionControl = Languages::where('project_id', $request->project_id)
            ->where('id', '!=', $id)
            ->where('language_code', $request->language_code)
            ->where('key', $request->key)
            ->where('version', $request->version)->count();
            
          if( $getVersionControl == 1){
            return redirect(route('languages.edit', $id))->with('error', 'HATA : Varolan projede aynı aynı dilde ve de aynı versiyon da bir çeviri eklemeye çalışıyorsunuz!');
          }
          $editLanguageQuery = Languages::where('id', $id)->update([
            "project_id"        => $request->project_id,
            "language_code"     => $request->language_code,
            "version"           => $request->version,
            "key"               => $request->key,
            "value"             => $request->value
          ]);

          if( $editLanguageQuery ){
            return redirect(route('languages.edit', $id))->with('success', 'Çeviri başarıyla güncellendi!');
          }
        }
      }
      else {
        $getLanguages = Languages::where('languages.id','=', $id)
          ->leftJoin('projects', 'languages.project_id', '=', 'projects.id')
          ->select(DB::raw('projects.id as project_id, project_name, languages.id as id, languages.project_id, languages.language_code, languages.version, languages.key, languages.value, languages.status'))
          ->first();

        return view('languages_edit', [ "languages" => $getLanguages ]);
      }
    }

    public function delete($id){
      if( is_null($id) != true ){
        $getProject = Projects::where('id', $id)->delete();
        if( $getProject ){
          return redirect('projects')->with('success', 'Proje başarıyla silindi.');
        }
        else {
          return redirect(route('projects'))->with('error', 'Ne yazık ki proje silinemedi.');
        }
      }
      else {
        return redirect(route('projects'))->with('error', 'Ne yazık ki proje bulunamadı!');
      }
    }
}
