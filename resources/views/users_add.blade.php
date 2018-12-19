@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <a href="{{ route('home') }}" class="btn btn-warning" style="float:right;margin-bottom:2%;">Anasayfaya Dön</a>
        <a href="{{ route('users') }}" class="btn btn-info" style="float:right;margin-bottom:2%;margin-right:1%;background-color:#666;border:1px solid #666;color:white">Geri Dön</a>
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
                <div class="card-header">Yeni Kullanıcı Oluştur</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('users.add') }}" onsubmit="return validateForm()" method="POST">
                      @csrf
                      <div class="row col-md-12">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="name">Adınız Soyadınız</label>
                            <input type="text" name="name" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="email">E-mail Adresiniz</label>
                            <input type="email" name="email" class="form-control">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="password">Şifreniz</label>
                            <input type="password" name="password" class="form-control" value="">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="password">Şifreniz ( Tekrar )</label>
                            <input type="password" name="password2" class="form-control" value="">
                          </div>
                        </div>
                        <div class="col-md-12" style="text-align:center;margin-top:1%;">
                          <span class="lead" style="font-size:10pt;"><b style="font-weight:bold;">Not:</b> Şifrenizi güncellemek istemiyorsanız lütfen boş bırakınız.</span>
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
<script>
function validateForm() {
  var x = $("input[name=password]").val();
  var y = $("input[name=password2]").val();
  if( x !== y ){
    alert('Girmiş olduğunuz şifreler eşleşmiyor, lütfen kontrol edip tekrar deneyiniz!');
    return false;
  }
}
</script>
@endsection
