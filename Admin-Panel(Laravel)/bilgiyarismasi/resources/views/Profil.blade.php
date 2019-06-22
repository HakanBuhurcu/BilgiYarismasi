@extends('anatasarim')
@section('Baslik','Soru Ekleme Sayfası')
@section('css')
    <link rel="stylesheet" href="css/sweetalert.min.css">
@endsection
@section('icerik')
    <br> <br>
    <div class = 'container' align="center">
        <div class="card" style="max-width:500px" >
            <div class="card-block" align="left">
                <div class = container>
                    <h4 class ='card-title'>Kullanıcı Profili</h4>
                    <form method ='post' id="form" action="">
                        {{csrf_field()}}
                        <div class="form-group col-md-10">
                            <label for="inputEmail4">Kullanıcı Adı:</label>
                            <input type="text" class="form-control" id="User_name" value="{{$user_info->name}}" name = "name">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="inputEmail4">Mail:</label>
                            <input type="text" class="form-control" id="CvpA"  value="{{$user_info->email}}" name = "mail">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="inputEmail4">Şifre:</label>
                            <input type="text" class="form-control" id="CvpA" placeholder="Şifre" name = "sifre">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="inputEmail4">Tekrar Şifre:</label>
                            <input type="text" class="form-control" id="CvpA" placeholder="Tekrar Şifre" name = "tsifre">
                        </div>

                        <button class="btn btn-primary"  type="submit">Kaydet</button>


                    </form>
                    <br>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="js/jquery.form.min.js"></script>
    <script src="js/jquery.validate.min.js"> </script>
    <script src="js/messages_tr.min.js"> </script>
    <script type="text/javascript" , src="{{url('js/sweetalert.min.js')}}"> </script>
    <script>
        $(document).ready(function(){
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

                 //  document.getElementById('username').value =  document.getElementById('User_name').value;
                    /*document.getElementById('CvpA').value = "";
                    document.getElementById('CvpB').value = "";
                    document.getElementById('CvpC').value = "";
                    document.getElementById('CvpD').value = "";
                    document.getElementById('PuanSelect').selectedIndex = 0;
                    document.getElementById('CvpSelect').selectedIndex = 0;*/
                }

            });
        });
    </script>

@endsection
