@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <a href="{{ route('home') }}" class="btn btn-warning" style="float:right;margin-bottom:2%;">Anasayfaya Dön</a>
        <a href="{{ route('projects') }}" class="btn btn-info" style="float:right;margin-bottom:2%;margin-right:1%;background-color:#666;border:1px solid #666;color:white">Geri Dön</a>
      </div>
        <div class="col-md-12">
          @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
          @endif
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="card">
                <div class="card-header">Projeyi Düzenle</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach( $projects as $project )
                    <form action="{{ route('projects.edit', $project->id) }}" method="POST">
                      @csrf
                      <div class="row col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="name">Proje Adı</label>
                            <input type="text" name="project_name" class="form-control" value="{{ $project->project_name }}">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="email">Durum</label>
                            <select name="status" class="form-control">
                              <option value="1" @if( $project->status == 1 ) {{ 'selected' }} @endif>Aktif</option>
                              <option value="0" @if( $project->status == 0 ) {{ 'selected' }} @endif>Pasif</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row col-md-12">
                        <button name="submit" type="submit" class="btn btn-warning btn-lg col-md-12" style="margin-top:2%">Güncelle</button>
                      </div>

                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
