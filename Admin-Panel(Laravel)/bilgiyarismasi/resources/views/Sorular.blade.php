@extends('anatasarim')
@section('Baslik','Soru Ekleme Sayfası')
@section('css')
    <link rel="stylesheet" href="{{url('css/sweetalert2.min.css')}}">
    @endsection
@section('icerik')
    <table class="table table-striped table-dark" id="soru_tablosu">
        <thead>
        <tr>
            <th scope="col">Soru No:</th>
            <th scope="col">Soru</th>
            <th scope="col">Cevap A</th>
            <th scope="col">Cevap B</th>
            <th scope="col">Cevap C</th>
            <th scope="col">Cevap D</th>
            <th scope="col">Doğru Cevap</th>
            <th scope="col">Puan</th>
            <th scope="col">Sil</th>
            <th scope="col">Düzenle</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sorular as $soru)
         <tr>
            <th scope="row">{{$soru->Soruno}}</th>
            <td>{{$soru->Soru}}</td>
            <td>{{$soru->a}}</td>
            <td>{{$soru->b}}</td>
            <td>{{$soru->c}}</td>
            <td>{{$soru->d}}</td>
            <td>{{$soru->Cvp}}</td>
             <td>{{$soru->Puan}}</td>
             <td>
                 <input type = "button" onclick="kayitSil(this,'{{$soru->Soruno}}')" class = "btn btn-danger" value="Sil">
             </td>
             <td>
                 <a href="{{url('SoruDuzenle')}}/{{$soru->Soruno}}"  class = "btn btn-success">Düzenle</a>
             </td>
        </tr>
        @endforeach

        </tbody>
    </table>
    <br>
@endsection
@section('js')
    <script type="text/javascript" , src="{{url('js/jquery.form.min.js')}}"></script>
    <script type="text/javascript" , src="{{url('js/jquery.validate.min.js')}}"> </script>
    <script type="text/javascript" , src="{{url('js/messages_tr.min.js')}}"> </script>
    <script type="text/javascript" , src="{{url('js/sweetalert2.min.js')}}"></script>
    <script>
      @if($kontrol==1)
        swal({
            position: 'top-right',
            type: 'success',
            title: 'Kayıt başarıyla değiştirildi',
            showConfirmButton: false,
            timer: 1500
        })
        @endif
    </script>
    <script>
        function kayitSil(satir_sirasi,soruno) {
            var sira = satir_sirasi.parentNode.parentNode.rowIndex;
            swal({
                title: 'Silmek istediğinize emin misiniz?',
                text: "Sildiğinizde geri dönüşümü olmayacaktır!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonText : 'İptal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet,Sil!'
            }).then((result) => {
                if(result.value)
            {
                var CSRF_TOKEN = $('meta[name = "csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: {
                        'soruNo': soruno,
                        '_token': CSRF_TOKEN
                    },
                    beforeSubmit: function () {
                        swal({
                            title: 'Loading...',
                            text: 'Yükleniyor lütfen bekleyiniz...',
                            showConfirmButton: false
                        })
                    },
                    success: function (response) {
                        if (response.durum == 'success') {
                            document.getElementById('soru_tablosu').deleteRow(sira);
                        }
                        swal(
                            response.baslik,
                            response.icerik,
                            response.durum
                        )
                    }
                });
            }
             })

        }
    </script>
    @endsection