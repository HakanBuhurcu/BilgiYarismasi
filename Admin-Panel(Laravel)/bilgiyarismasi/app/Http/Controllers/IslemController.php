<?php

namespace App\Http\Controllers;

use App\Oduller;
use App\Sorular;
use App\Uyeler;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;

class IslemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function get_SoruEkle(){
        return view('SoruEkle');

    }
    public function get_Sorular($kontrolDegeri){
        $sorular = Sorular::all();
        return view('Sorular',['sorular'=>$sorular,'kontrol'=>$kontrolDegeri]);
    }
    public function post_SoruEkle(Request $request)
    {
        try {
            Sorular::create($request->all());
            return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Soru başarıyla kaydedildi.']);

        } catch (Exception $e) {
            return response(['durum' => 'error', 'baslik' => 'Hata', 'icerik' => 'Soru kaydedilemedi.']);
        }
    }
        public function post_Sorular(Request $request){
            try{
                Sorular::where('Soruno',$request->soruNo)->delete();
                return response(['durum'=>'success','baslik'=>'Başarılı','icerik'=>'Soru başarıyla silindi.']);

            }catch(Exception $e){
                return response(['durum'=>'error','baslik'=>'Hata','icerik'=>'Soru silinemedi.']);
            }

    }

        public function post_SoruDuzenle($soruno,Request $request){
            try{
                $request->offsetUnset('_token');
                Sorular::where('Soruno',$soruno)->update($request->all());
                return redirect('Sorular/1');
            }catch (Exception $e){
                echo ('<script>alert("hata")</script>');
            }

        }

        public function get_SoruDuzenle($soruno){
        $soru=Sorular::where('Soruno',$soruno)->first();
        return view('SoruDuzenle')->with('soru',$soru);
       }


    public function get_SezonIslemleri(){
        return view('Sezon')->with('tableVisible',0);
    }

    public function post_Sezon(){
        Uyeler::query()->update(["Oduldurum"=> -1]);
        $uyeler = Uyeler::orderBy('Puan','desc')->take(5)->get();
        return view('Sezon',['uyeler'=>$uyeler,'tableVisible'=>1]);

    }

    public function get_Oduller(){
        $oduller = Oduller::where('Aktiflik',1)->orderBy('Derece')->get();
        $max_id = DB::table('oduller')->max('OdulId');
        return view('Oduller',['oduller'=>$oduller, 'max_id'=>$max_id]);
    }

    public function post_Oduller(Request $request){
        $request->offsetUnset('_token');
        if($request->submit_type) {
            if (!($request->kontrol_degeri)) {
                try {
                    $max_derece = Oduller::where('Aktiflik', 1)->max('Derece');
                    Oduller::create(['OdulIsmi' => $request->odul_ismi, 'Derece' => $max_derece + 1]);
                    return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Yeni Ödül Eklendi.']);
                } catch (Exception $e) {
                    return response(['durum' => 'error', 'baslik' => 'Hata', 'icerik' => 'İşlem Başarısız.']);
                }
            } else {
                try {
                    Oduller::where('OdulId', $request->odul_id)->update(['Aktiflik' => 0]);
                    Oduller::create(['OdulIsmi' => $request->odul_ismi, 'Derece' => $request->derece]);
                    return response(['durum' => 'success', 'baslik' => 'Başarılı', 'icerik' => 'Ödül Değiştirildi']);
                } catch (Exception $e) {
                    return response(['durum' => 'error', 'baslik' => 'Hata', 'icerik' => 'İşlem Başarısız.']);
                }

            }
        }
        else if(!($request->submit_type)){
            try{
                Oduller::where('OdulId',$request->odul_id)->update(['Aktiflik'=> 0]);
                $derece = Oduller::where('OdulId',$request->odul_id)->pluck('Derece');
                DB::table('oduller')->where('Derece','>',$derece)->decrement('Derece');
              //  return response(['durum'=>'success','baslik'=>'Başarılı','icerik'=>'Soru başarıyla silindi.']);
                return redirect('Oduller');

            }catch(Exception $e){
                return response(['durum'=>'error','baslik'=>'Hata','icerik'=>'Soru silinemedi.']);
            }
        }

    }

    public function get_Profil(){
        $user_info = Auth::user();
        return view('Profil')->with('user_info',$user_info);
    }

    public function post_Profil(Request $request){
        $user_info = Auth::user();
       //  if($request->sifre => $request->tsifre) {
             $user_info->name = $request->get('name');
             $user_info->email = $request->get('mail');
             $user_info->password = bcrypt($request->get('sifre'));
             $user_info->save();
           //  User::where('mail', $user_info->mail)->update(["name"=> -1])
             return response(['durum'=>'success','baslik'=>'Başarılı','icerik'=>'Kayıt Güncellendi.']);
       //  }
        // else{
          //   return response(['durum'=>'error','baslik'=>'Hata','icerik'=>'Sifreler eşleşmiyor']);
        // }
    }

}
