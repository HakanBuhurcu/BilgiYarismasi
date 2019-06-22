<!DOCTYPE html>
<html>
<head>
    <title>@yield('Baslik','boş sayfa')</title>
    <meta charset="utf-8">
    <meta name = "csrf-token" content="{{csrf_token()}}">

    <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">

    @yield('css')

</head>


<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Online Bilgi Yarişması</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @if(Auth::check())
             <li class="nav-item">
                <a class="nav-link" href="{{url('SoruEkle')}}">Soru Ekle</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('Sorular/0')}}">Sorular</a>
            </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('SezonIslemleri')}}">Sezon Belirle</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('Oduller')}}">Ödüller</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{url('Profil')}}">Kullanıcı Profili</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Çıkış</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>




        </ul>
    </div>
    <p class ="text-warning" id="username" >Hoşgeldiniz {{ Auth::user()->name }}</p>
    @endif
</nav>
@yield('icerik')
<script type="text/javascript" , src="{{url('js/jquery.js')}}" ></script>
<script type="text/javascript" , src="{{url('js/tether.min.js')}}" ></script>
<script type="text/javascript" , src="{{url('js/bootstrap.min.js')}}" ></script>
@yield('js')


</body>
</html>