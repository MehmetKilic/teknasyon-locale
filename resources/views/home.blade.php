@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        @if (session('success'))
          <div class="alert alert-success" role="alert">
              {{ session('success') }}
          </div>
        @elseif(session('error'))
          <div class="alert alert-error" role="alert">
              {{ session('error') }}
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
            <div class="card-header">Localization Manager</div>
              <div class="panel-body">
                <div class="row" style="margin-top:4%;margin-bottom:4%;">

                  <div class="col-md-6">
                    <a href="{{ route('projects') }}" style="text-decoration:none;">
                      <div class="btn btn-default btn-lg btn-block">
                        <i class="fas fa-hammer fa-4x"></i></i><br><br>
                        Proje Yönetimi
                      </div>
                    </a>
                  </div>

                  <div class="col-md-6">
                    <a href="{{ route('users') }}" style="text-decoration:none;">
                      <div class="btn btn-default btn-lg btn-block">
                        <i class="fas fa-users fa-4x"></i><br><br>
                        Kullanıcı Yönetimi
                      </div>
                    </a>
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
</div>
@endsection
