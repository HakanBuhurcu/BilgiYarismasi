@extends('anatasarim')
@section('Baslik','Yönetici Girişi')
@section('icerik')
    <br><br>
    <div class = 'container' align="center">
        <div class="card" style="max-width:500px" >
            <div class="card-block" align="left">
                <div class = container>
                    <br>
                    <h4 class ='card-title'>Yönetici Girişi</h4>
                    <form method ='post' action="{{ route('login') }}">
                        {{csrf_field()}}
                        <label for="validationServer01">Kullanıcı Adı</label>
                        <input type="email" name = 'email' class="form-control {{ $errors->has('email') ? 'is-invalid' : 'is-valid' }}" id="validationServer01" placeholder="Kullanıcı adı" value="{{ old('email') }}" required>
                        <div class="invalid-feedback">
                            Kullanıcı adı ve/veya şifre yanlış
                        </div>

                        <label for="validationServer01">Parola</label>
                        <input type="password" name = 'password' class="form-control {{ $errors->has('email') ? 'is-invalid' : 'is-valid' }}" id="validationServer01" placeholder="Parola"  required>
                        <br>
                        <button class="btn btn-primary" type="submit">Giriş Yap</button>
                        <br>
                        <label></label>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection