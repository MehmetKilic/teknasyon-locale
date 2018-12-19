@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <a href="{{ route('home') }}" class="btn btn-warning" style="float:right;margin-bottom:2%;">Anasayfaya Dön</a>
        <a href="{{ route('languages', $languages->project_id) }}" class="btn btn-info" style="float:right;margin-bottom:2%;margin-right:1%;background-color:#666;border:1px solid #666;color:white">Geri Dön</a>
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
                <div class="card-header">Çeviri Düzenle</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('languages.edit', $languages->id) }}" method="POST">
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
                              <option value="AF" @if( $languages->language_code == 'AF' ) {{ 'selected' }} @endif>Afrikans</option>
                              <option value="SQ" @if( $languages->language_code == 'SQ' ) {{ 'selected' }} @endif>Albanian</option>
                              <option value="AR" @if( $languages->language_code == 'AR' ) {{ 'selected' }} @endif>Arabic</option>
                              <option value="CS" @if( $languages->language_code == 'CS' ) {{ 'selected' }} @endif>Czech</option>
                              <option value="DA" @if( $languages->language_code == 'DA' ) {{ 'selected' }} @endif>Danish</option>
                              <option value="NL" @if( $languages->language_code == 'NL' ) {{ 'selected' }} @endif>Dutch</option>
                              <option value="EN" @if( $languages->language_code == 'EN' ) {{ 'selected' }} @endif>English</option>
                              <option value="FR" @if( $languages->language_code == 'FR' ) {{ 'selected' }} @endif>French</option>
                              <option value="DE" @if( $languages->language_code == 'DE' ) {{ 'selected' }} @endif>German</option>
                              <option value="IT" @if( $languages->language_code == 'IT' ) {{ 'selected' }} @endif>Italian</option>
                              <option value="KO" @if( $languages->language_code == 'KO' ) {{ 'selected' }} @endif>Korean</option>
                              <option value="LA" @if( $languages->language_code == 'LA' ) {{ 'selected' }} @endif>Latin</option>
                              <option value="PT" @if( $languages->language_code == 'PT' ) {{ 'selected' }} @endif>Portuguese</option>
                              <option value="RO" @if( $languages->language_code == 'RO' ) {{ 'selected' }} @endif>Romanian</option>
                              <option value="RU" @if( $languages->language_code == 'RU' ) {{ 'selected' }} @endif>Russian</option>
                              <option value="SL" @if( $languages->language_code == 'SL' ) {{ 'selected' }} @endif>Slovenian</option>
                              <option value="ES" @if( $languages->language_code == 'ES' ) {{ 'selected' }} @endif>Spanish</option>
                              <option value="SV" @if( $languages->language_code == 'SV' ) {{ 'selected' }} @endif>Swedish </option>
                              <option value="TR" @if( $languages->language_code == 'TR' ) {{ 'selected' }} @endif>Turkish</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="name">Version</label>
                            <input type="text" name="version" class="form-control" value="{{ $languages->version }}">
                          </div>
                        </div>
                      </div>

                      <div class="row col-md-12">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="name">Anahtar Değer</label>
                            <input type="text" name="key" class="form-control" value="{{ $languages->key }}">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="name">Çeviri</label>
                            <textarea name="value" class="form-control">{{ $languages->value }}</textarea>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" name="project_id" value="{{ $languages->project_id }}">

                      <div class="row col-md-12">
                        <button name="submit" type="submit" class="btn btn-warning btn-lg col-md-12" style="margin-top:2%">Güncelle</button>
                      </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
