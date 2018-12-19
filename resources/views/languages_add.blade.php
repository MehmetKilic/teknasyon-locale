@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <a href="{{ route('home') }}" class="btn btn-warning" style="float:right;margin-bottom:2%;">Anasayfaya Dön</a>
        <a href="{{ route('languages', $languages->id) }}" class="btn btn-info" style="float:right;margin-bottom:2%;margin-right:1%;background-color:#666;border:1px solid #666;color:white">Geri Dön</a>
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
                <div class="card-header">Çeviri Ekle</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('languages.add', $languages->id) }}" method="POST">
                      @csrf
                      <div class="row col-md-12">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="name">Proje Adı</label>
                            <input type="text" name="project_name" class="form-control" value="{{ $languages->project_name }}" disabled>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="name">Dil</label>
                            <select name="language_code" class="form-control">
                              <option value="AF">Afrikans</option>
                              <option value="SQ">Albanian</option>
                              <option value="AR">Arabic</option>
                              <option value="CS">Czech</option>
                              <option value="DA">Danish</option>
                              <option value="NL">Dutch</option>
                              <option value="EN">English</option>
                              <option value="FR">French</option>
                              <option value="DE">German</option>
                              <option value="IT">Italian</option>
                              <option value="KO">Korean</option>
                              <option value="LA">Latin</option>
                              <option value="PT">Portuguese</option>
                              <option value="RO">Romanian</option>
                              <option value="RU">Russian</option>
                              <option value="SL">Slovenian</option>
                              <option value="ES">Spanish</option>
                              <option value="SV">Swedish </option>
                              <option value="TR">Turkish</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="name">Version</label>
                            <input type="text" name="version" class="form-control" value="">
                          </div>
                        </div>
                      </div>

                      <div class="row col-md-12">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="name">Anahtar Değer</label>
                            <input type="text" name="key" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="name">Çeviri</label>
                            <textarea name="value" class="form-control"></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="row col-md-12">
                        <button name="submit" type="submit" class="btn btn-success btn-lg col-md-12" style="margin-top:2%">Oluştur</button>
                      </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
