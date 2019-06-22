@extends('anatasarim')
@section('Baslik','Soru Düzenleme Sayfası')
@section('css')
    <link rel="stylesheet" href="css/sweetalert.min.css">
@endsection
@section('icerik')
    <br><br>
    <div class = 'container' align="center">
        <div class="card" style="max-width:700px" >
            <div class="card-block" align="left">
                <div class = container>
                    <br>
                    <h4 class ='card-title'>Soru Düzenleme Bölümü</h4>
                    <form method ='post' id="DuzenlemeFormu" action="">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Soru:</label>
                            <textarea class="form-control" id="SoruAlaniUpdt" rows="2" name = "Soru">{{$soru->Soru}}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cevap A:</label>
                                <input type="text" class="form-control" id="CvpAUpdt" placeholder="A Seçeneğini yazın" name = "a" value="{{$soru->a}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Cevap B:</label>
                                <input type="text" class="form-control" id="CvpBUpdt" placeholder="B Seçeneğini Yazın." name = "b" value="{{$soru->b}}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cevap C:</label>
                                <input type="text" class="form-control" id="CvpCUpdt" placeholder="C Seçeneğini yazın" name = "c" value="{{$soru->c}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Cevap D:</label>
                                <input type="text" class="form-control" id="CvpDUpdt" placeholder="D Seçeneğini Yazın." name = "d" value="{{$soru->d}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4" >
                                <label for="inputState">Puan:</label>
                                <select id="PuanSelect" class="form-control" name = "Puan">
                                    <option>Puan Seç...</option>
                                    <option {{($soru->Puan == '100') ? ' selected' : ''}}>100</option>
                                    <option {{($soru->Puan == '200') ? ' selected' : ''}}>200</option>
                                    <option {{($soru->Puan == '300') ? ' selected' : ''}}>300</option>
                                    <option {{($soru->Puan == '400') ? ' selected' : ''}}>400</option>
                                    <option {{($soru->Puan == '500') ? ' selected' : ''}}>500</option>
                                    <option {{($soru->Puan == '600') ? ' selected' : ''}}>600</option>
                                    <option {{($soru->Puan == '700') ? ' selected' : ''}}>700</option>
                                    <option {{($soru->Puan == '800') ? ' selected' : ''}}>800</option>
                                    <option {{($soru->Puan == '900') ? ' selected' : ''}}>900</option>
                                    <option {{($soru->Puan == '1000') ? ' selected' : ''}}>1000</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4" >
                                <label for="deneme">Doğru Cevap:</label>
                                <select id="CvpSelect" class="form-control" name = "Cvp">
                                    <option>Cevap Seç...</option>
                                    <option {{($soru->Cvp == 'A') ? ' selected' : ''}}>A</option>
                                    <option {{($soru->Cvp == 'B') ? ' selected' : ''}}>B</option>
                                    <option {{($soru->Cvp == 'C') ? ' selected' : ''}}>C</option>
                                    <option {{($soru->Cvp == 'D') ? ' selected' : ''}}>D</option>

                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary"  type="submit">Kaydet</button>
                    </form>
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
      /* $(document).ready(function(){
            $('DuzenlemeFormu').validate();
            $('DuzenlemeFormu').ajaxForm({
                beforeSubmit:function () {
                    swal({
                        title:'Loading...',
                        text:'Yükleniyor lütfen bekleyiniz...',
                        showConfirmButton:false
                    })
                },
                success:function () {
                    swal(
                        'Başarılı',
                        'Kayıt başarıyla değiştirildi',
                        'success');


                }

            });
        });*/
    </script>


@endsection
