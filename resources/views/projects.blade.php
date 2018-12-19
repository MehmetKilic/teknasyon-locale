@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <a href="{{ route('home') }}" class="btn btn-warning" style="float:right;margin-bottom:2%;margin-left:1%;">Anasayfaya Dön</a>
        <a href="{{ route('projects.add') }}" class="btn btn-success" style="float:right;margin-bottom:2%;">Proje Oluştur</a>
      </div>
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
            <div class="card-header">Proje Yönetimi</div>
              <div class="panel-body">

              <table class="table table-condensed" style="text-align:center;">
                <thead style="text-align:center;">
                  <tr>
                    <th style="text-align:center;"> # ID</th>
                    <th style="text-align:center;"> Proje Adı</th>
                    <th style="text-align:center;"> Durum</th>
                    <th style="text-align:center;"> İşlem</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach( $projects as $project )
                  <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->project_name }}</td>
                    <td>
                      @if( $project->status == 1)
                        <span class="btn btn-success btn-sm">Aktif</span>
                      @else
                        <span class="btn btn-danger btn-sm">Pasif</span>
                      @endif
                    </td>
                    <td>
                      <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                      <a href="{{ route('languages', $project->id) }}" class="btn btn-info btn-sm" style="background-color:white;color:black;border:1px solid #666;">Dil Yönetimi</a>
                      <button type="button" data-toggle="modal" data-target="#VazgecModal{{ $project->id }}" class="btn btn-danger btn-sm">Sil</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <span style="margin-left:3%;"> {{ $projects->links() }} </span>
          </div>
          @foreach( $projects as $project )
          <!-- Vazgeç Modal -->
          <div class="modal fade" id="VazgecModal{{ $project->id }}" tabindex="-1" role="dialog" aria-labelledby="VazgecModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body text-center">
                  <h5><strong>Veriyi silmek istediğinizden eminmisiniz ?</strong></h5>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                  <a href="{{ route('projects.delete', $project->id ) }}" class="btn btn-danger">Sil</a>
                </div>
              </div>
            </div>
          </div><!--Vazgeç modal sonu-->
          @endforeach
        </div>
      </div>
    </div>
@endsection
