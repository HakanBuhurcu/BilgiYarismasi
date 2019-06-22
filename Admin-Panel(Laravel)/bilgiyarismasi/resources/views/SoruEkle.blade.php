@extends('anatasarim')
@section('Baslik','Soru Ekleme Sayfası')
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
                    <h4 class ='card-title'>Soru Ekleme Bölümü</h4>
                    <form method ='post' id="form" action="">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Soru:</label>
                            <textarea class="form-control" id="SoruAlani" rows="2" name = "Soru"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cevap A:</label>
                                <input type="text" class="form-control" id="CvpA" placeholder="A Seçeneğini yazın" name = "a">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Cevap B:</label>
                                <input type="text" class="form-control" id="CvpB" placeholder="B Seçeneğini Yazın." name = "b" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Cevap C:</label>
                                <input type="text" class="form-control" id="CvpC" placeholder="C Seçeneğini yazın" name = "c">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Cevap D:</label>
                                <input type="text" class="form-control" id="CvpD" placeholder="D Seçeneğini Yazın." name = "d">
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-4" >
                            <label for="inputState">Puan:</label>
                            <select id="PuanSelect" class="form-control" name = "Puan">
                                <option selected>Puan Seç...</option>
                                <option>100</option>
                                <option>200</option>
                                <option>300</option>
                                <option>400</option>
                                <option>500</option>
                                <option>600</option>
                                <option>700</option>
                                <option>800</option>
                                <option>900</option>
                                <option>1000</option>
                            </select>
                        </div>
                            <div class="form-group col-md-4" >
                            <label for="deneme">Doğru Cevap:</label>
                            <select id="CvpSelect" class="form-control" name = "Cvp">
                                <option selected>Cevap Seç...</option>
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>

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

                    document.getElementById('SoruAlani').value = "";
                    document.getElementById('CvpA').value = "";
                    document.getElementById('CvpB').value = "";
                    document.getElementById('CvpC').value = "";
                    document.getElementById('CvpD').value = "";
                    document.getElementById('PuanSelect').selectedIndex = 0;
                    document.getElementById('CvpSelect').selectedIndex = 0;
                }

            });
        });
    </script>

    @endsection
