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
                    <input type = "button" onclick="odul_sil('{{$odul->OdulId}}',this)" class = "btn btn-danger" value="Sil">
                </td>
                <td>
                    <input type = "button" onclick="duzenle('{{$odul->OdulIsmi}}','{{$odul->OdulId}}',this)" class = "btn btn-success" value="Düzenle">
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
        var kontrol_degeri = 0;
        var odul_id = 0;
        var sira_no = 0;
        var max_id = {{$max_id}};
      //  var odul_id,sira_no,kontrol_degeri = 0;
      function kaydet() {
          var odul_ismi = document.getElementById('odul_text').value;
          var CSRF_TOKEN = $('meta[name = "csrf-token"]').attr('content');
          max_id = max_id + 1;
          $.ajax({
              type: 'POST',
              url: '',
              data: {
                  'odul_ismi': odul_ismi,
                  'kontrol_degeri': kontrol_degeri,
                  'odul_id': odul_id,
                  'derece': sira_no,
                  'submit_type': 1,
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
                  swal(
                      response.baslik,
                      response.icerik,
                      response.durum
                  );
                  if(kontrol_degeri) {

                      var x = document.getElementById("odul_tablosu").rows[sira_no].cells;
                      x[1].innerHTML = odul_ismi;
                      x[2].innerHTML = "<input type = \"button\" onclick=\"odul_sil('" + max_id + "',this)\" class = \"btn btn-danger\" value=\"Sil\">";
                      x[3].innerHTML = "<input type = \"button\" onclick=\"duzenle('" + odul_ismi + "','" + max_id + "',this)\" class = \"btn btn-success\" value=\"Düzenle\">";
                  }
                  else {

                      var table = document.getElementById("odul_tablosu");
                      var row_count = table.rows.length;
                      var x = document.createElement("TH");
                      var t = document.createTextNode(row_count);
                      x.appendChild(t);
                      var row = table.insertRow(row_count);
                      row.appendChild(x);
                      var cell1 = row.insertCell(1);
                      var cell2 = row.insertCell(2);
                      var cell3 = row.insertCell(3);
                      cell1.innerHTML = odul_ismi;
                      cell2.innerHTML = "<input type = \"button\" onclick=\"odul_sil('" + max_id + "',this)\" class = \"btn btn-danger\" value=\"Sil\">";
                      cell3.innerHTML = "<input type = \"button\" onclick=\"duzenle('" + odul_ismi + "','" + max_id + "',this)\" class = \"btn btn-success\" value=\"Düzenle\">";
                  }
              }
          });
      }
      function duzenle(odulismi,odulid,sira) {
            document.getElementById('odul_text').value = odulismi;
            odul_id = odulid;
            sira_no = sira.parentNode.parentNode.rowIndex;
            kontrol_degeri = 1;
        }
        function odul_sil(odul_id,satir_sirasi){
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
                        'odul_id': odul_id,
                        'submit_type': 0,
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
                        swal(
                            response.baslik,
                            response.icerik,
                            response.durum
                        )
                        var table = document.getElementById("odul_tablosu");
                        var row_count = table.rows.length;
                        table.deleteRow(sira);
                        var d = sira + 1;
                        for (var i = d; i<row_count - 1;i++ ){
                           var x =  table.rows[i].cells;
                           x[0].innerHTML = i - 1;
                        }
                    }
                });
            }
        })

        }


    </script>
@endsection