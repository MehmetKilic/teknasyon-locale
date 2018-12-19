@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <a href="{{ route('home') }}" class="btn btn-warning" style="float:right;margin-bottom:2%;margin-left:1%;">Anasayfaya Dön</a>
        <a href="{{ route('languages.add', $id) }}" class="btn btn-success" style="float:right;margin-bottom:2%;">Çeviri Ekle</a>
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
            <div class="card-header">Dil Yönetimi</div>
              <div class="panel-body">

              <table class="table table-condensed" style="text-align:center;">
                <thead style="text-align:center;">
                  <tr>
                    <th style="text-align:center;"> Proje Adı</th>
                    <th style="text-align:center;"> Dil Kodu</th>
                    <th style="text-align:center;"> Versiyon</th>
                    <th style="text-align:center;"> Anahtar Değer</th>
                    <th style="text-align:center;"> İşlem</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach( $languages as $language )
                  <tr>
                    <td>{{ $language->project_name }}</td>
                    <td>{{ $language->language_code }}</td>
                    <td>{{ $language->version }}</td>
                    <td>{{ substr($language->key,0,20) }}</td>
                    <td>
                      <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-warning btn-sm">Düzenle</a>
                      <button type="button" data-toggle="modal" data-target="#VazgecModal{{ $language->id }}" class="btn btn-danger btn-sm">Sil</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <span style="margin-left:3%;"> {{ $languages->links() }} </span>
          </div>
          @foreach( $languages as $language )
          <!-- Vazgeç Modal -->
          <div class="modal fade" id="VazgecModal{{ $language->id }}" tabindex="-1" role="dialog" aria-labelledby="VazgecModalLabel">
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
                  <a href="{{ route('languages.delete', $language->id ) }}" class="btn btn-danger">Sil</a>
                </div>
              </div>
            </div>
          </div><!--Vazgeç modal sonu-->
          @endforeach
        </div>
      </div>
    </div>
@endsection
