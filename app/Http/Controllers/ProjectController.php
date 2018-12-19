<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project as Projects;
use Validator;

class ProjectController extends Controller
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
        $getAlProjects = Projects::paginate(10);
        return view('projects', ["projects" => $getAlProjects]);
    }

    public function add(Request $request){
      if( $_POST ){
        // @note Best practices açısından aslında burası store ve messages metodu ile ilerlemeliydi
        $messages = [
            'project_name.required' => 'Proje adı alanı zorunlu, lütfen doldurduğunuzdan emin olunuz.',
            'project_name.max' => 'Proje adı alanı için girelebilir maksimum karakter sayısı 255. Lütfen girdiğiniz değeri kontrol ediniz',
            'project_name.unique' => 'Aynı ada sahip başka bir proje bulunmakta, lütfen proje isminizi kontrol ediniz!'
        ];

        $validator = Validator::make($request->all(), [
            'project_name' => 'required|max:255|unique:projects'
          ],
          $messages
        );

        if ($validator->fails()) {
          return redirect(route('projects.add'))->withInput()->withErrors($validator);
        }
        else {
          $addProjectQuery = Projects::create([
            "project_name"      => $request->project_name,
            "status"            => $request->status
          ]);

          if( $addProjectQuery ){
            return redirect(route('projects'))->with('success', 'Proje başarıyla oluşturuldu!');
          }
        }
      }
      else {
        return view('projects_add');
      }
    }

    public function edit(Request $request, $id){
      if( $_POST ){
        // @note Best practices açısından aslında burası store ve messages metodu ile ilerlemeliydi
        $messages = [
          'project_name.required' => 'Proje adı alanı zorunlu, lütfen doldurduğunuzdan emin olunuz.',
          'project_name.max' => 'Proje adı alanı için girelebilir maksimum karakter sayısı 255. Lütfen girdiğiniz değeri kontrol ediniz',
          'project_name.unique' => 'Aynı ada sahip başka bir proje bulunmakta, lütfen proje isminizi kontrol ediniz!'
        ];

        $validator = Validator::make($request->all(), [
            'project_name' => 'required|max:255|unique:projects,project_name,'.$id.',id',
          ],
          $messages
        );

        if ($validator->fails()) {
          return redirect(route('projects.edit', $id))->withInput()->withErrors($validator);
        }
        else {
          $editProjectQuery = Projects::where('id', $id)->update([
            "project_name"      => $request->project_name,
            "status"            => $request->status
          ]);

          if( $editProjectQuery ){
            return redirect(route('projects.edit', $id))->with('success', 'Proje başarıyla güncellendi!');
          }
        }
      }
      else {
        $getProject = Projects::where('id', $id)->get();
        return view('projects_edit', [ "projects" => $getProject ]);
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
