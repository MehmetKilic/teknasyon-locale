<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project as Projects;
use App\Languages as Languages;
use Cache;

class ApiController extends Controller{

  public function getLocale(Request $request)
  {
    if( !empty($request->header('id')) and
        !empty($request->header('language')) and
        !empty($request->header('key')) and
        !empty($request->header('version'))
    ){
      $projects = Projects::where('projects.id',$request->header('id'))
      ->leftJoin("languages", "languages.project_id", "=", "projects.id")
      ->where('language_code', $request->header('language'))
      ->where('key', $request->header('key'))
      ->where('version', $request->header('version'))
      ->get();

      Cache::forever('locale', $projects);

      return response()->json($projects);
    }
    else {
      return response()->json(["status" => "error", "message" => "Ne yazık ki parametreler eksik"]);
    }
  }
}
