@extends('anatasarim')
@section('Baslik','Ödüller')
@section('css')
    <link rel="stylesheet" href="{{url('css/sweetalert2.min.css')}}">
@endsection

@section('icerik')

    <div class = 'container' align="center" style="max-width:1000px">
        <table class="table" id="odul_tablosu">
            <thead>
            <tr>
                <th scope="col">Derece</th>
                <th scope="col">Açıklama</th>
                <th scope="col">Sil</th>
                <th scope="col">Düzenle</th>
            </tr>
            </thead>
            <tbody>
            @foreach($oduller as $odul)
                <tr>
                    <th scope="row">{{$odul->Derece}}</th>
                    <td>{{$odul->OdulIsmi}} </td>
                    <td>
                        <input type = "button"  class = "btn btn-danger" value="Sil">
                    </td>
                    <td>
                        <input type = "button" onclick="kaydet('{{$odul->Derece}}')" class = "btn btn-success" value="Düzenle">
                    </td>

                </tr>
            @endforeach
            </tbody>

        </table>

        <div class="input-group mb-3" style="max-width:700px">
            <input type="text" class="form-control"  placeholder="Yeni Ödül Ekle" id="odul_text" aria-describedby="basic-addon2" value="">
            <div class="input-group-append">
                <input type = "button" onclick="kaydet()" class="btn btn-outline-secondary" id="odul_buton" style="width:100px" value="Kaydet">
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" , src="{{url('js/jquery.form.min.js')}}"></script>
    <script type="text/javascript" , src="{{url('js/jquery.validate.min.js')}}"> </script>
    <script type="text/javascript" , src="{{url('js/messages_tr.min.js')}}"> </script>
    <script type="text/javascript" , src="{{url('js/sweetalert2.min.js')}}"></script>
    <script>
        //  var odul_id,sira_no,kontrol_degeri = 0;
        function kaydet(soruno) {
            /*var x = document.getElementById("odul_tablosu").rows[1].cells;
            x[1].innerHTML = document.getElementById('odul_text').value;*/
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
                var CSRF_TOKENN = $('meta[name = "csrf-tokenn"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: {
                        'soruNo': soruno,
                        '_token': CSRF_TOKENN
                    },
                    beforeSubmit: function () {
                        swal({
                            title: 'Loading...',
                            text: 'Yükleniyor lütfen bekleyiniz...',
                            showConfirmButton: false
                        })
                    },
                    success: function (response) {
                        /*  if (response.durum == 'success') {
                              document.getElementById('soru_tablosu').deleteRow(sira);
                          }*/
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
        /*   function duzenle(odulismi,odulid,sira) {
               document.getElementById('odul_text').value = odulismi;
               document.getElementById('odul_buton').value = "Kaydet";
               odul_id = odulid;
               sira_no = sira.parentNode.parentNode.rowIndex;
               kontrol_degeri = 1;
           }*/


    </script>
@endsection