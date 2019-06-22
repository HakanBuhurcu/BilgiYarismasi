@extends('anatasarim')
@section('Baslik','Sezon ve Ödül İşlemleri')
@section('css')
    <link rel="stylesheet" href="css/sweetalert.min.css">
@endsection
@section('icerik')
    <div class = 'container' align="center">
        <div class = container>
            <br>
            <br>
            <form method ='post' id="form" action="">
                {{csrf_field()}}
                <button class="btn btn-danger"  type="submit">Sezonu Bitir!</button>
            </form>
            <br>
            @if($tableVisible)
              <table class="table table-striped table-dark" id="kullanicilar">
                  <thead>
                   <tr>
                       <th scope="col">No:</th>
                     <th scope="col">Kullanıcı Adı:</th>
                     <th scope="col">Puan:</th>
                   </tr>
                  </thead>
                  <tbody>
                     <?php $deger = 0; ?>
                    @foreach($uyeler as $uye)
                     <?php  $deger = $deger + 1;?>
                      <tr>
                        <th scope="row">{{$deger}}</th>
                        <td>{{$uye->Kullancad}}</td>
                        <td>{{$uye->Puan}}</td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            @endif

            </div>
    </div>



@endsection
@section('js')
    <script src="js/jquery.form.min.js"></script>
    <script src="js/jquery.validate.min.js"> </script>
    <script src="js/messages_tr.min.js"> </script>
    <script type="text/javascript" , src="{{url('js/sweetalert.min.js')}}"> </script>
    <script>
      /*  $(document).ready(function(){
            $('form').validate();
            $('form').ajaxForm({
                beforeSubmit:function () {
                    swal({
                        title:'Loading...',
                        text:'Yükleniyor lütfen bekleyiniz...',
                        showConfirmButton:false
                    })
                },
                success:function (response) {
                    swal(
                        response.baslik,
                        response.icerik,
                        response.durum)

                }

            });
        });*/
    </script>

@endsection