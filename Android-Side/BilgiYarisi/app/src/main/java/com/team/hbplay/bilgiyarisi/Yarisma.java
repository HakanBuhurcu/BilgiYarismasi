package com.team.hbplay.bilgiyarisi;

import android.app.Dialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.graphics.Rect;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;
import java.util.Random;


public class Yarisma extends AppCompatActivity {

    Button jokerelli,jokerybes,jokercift,jokerpas,CevapA,CevapB,CevapC,CevapD;
    TextView kullaniciAdi,Puan,jkrElli,jkrYbes,jkrCift,jkrPas,Soru,zaman;
    SharedPreferences sharedPreferences;
    boolean basildiMi = false;
    Handler timerHandler = null;
    Runnable timerRunnable = null;
    int kalan_zaman = 14;
    boolean is_pause = true;
    RequestQueue requestQueue;
    private static final String soruUrl = "http://192.168.43.174/Sorular.php";
   // private static final String puanEkleUrl = "http://192.168.43.174/puanEkle.php";
    String cevap = "";
    int Soru_Puan = 0;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.sorular);

        jokerelli = (Button)findViewById(R.id.btelli);
        jokerybes = (Button)findViewById(R.id.btybes);
        jokercift = (Button)findViewById(R.id.btiki);
        jokerpas = (Button)findViewById(R.id.btpas);
        CevapA = (Button)findViewById(R.id.button22);
        CevapB= (Button)findViewById(R.id.button21);
        CevapC = (Button)findViewById(R.id.button23);
        CevapD = (Button)findViewById(R.id.button20);

        kullaniciAdi = (TextView)findViewById(R.id.textView15);
        Puan = (TextView)findViewById(R.id.textView16);
        jkrElli = (TextView)findViewById(R.id.textelli);
        jkrYbes = (TextView)findViewById(R.id.textybes);
        jkrCift = (TextView)findViewById(R.id.textiki);
        jkrPas = (TextView)findViewById(R.id.textpas);
        zaman = (TextView)findViewById(R.id.textView18);
        Soru = (TextView)findViewById(R.id.textView19);
        requestQueue = Volley.newRequestQueue(getApplicationContext());

        SoruGetir(100);

        timerHandler =  new Handler();
         timerRunnable = new Runnable() {

            @Override
            public void run() {
                if(is_pause) {
                    zaman.setText(String.valueOf(kalan_zaman));
                    if (kalan_zaman != 0) {
                        kalan_zaman--;
                    } else {
                        showMyCustomAlertDialog();
                        zaman.setText(String.valueOf(0));
                        is_pause = false;
                        timerHandler.removeCallbacks(timerRunnable);
                    }
                    timerHandler.postDelayed(timerRunnable, 1000);
                }
            }

        };
        timerRunnable.run();




    }

    public void a_buton(View v){
        if(cevap.equals("a")){
            kalan_zaman = 13;

        }
        else{

        }
        is_pause = false;

    }
    public void b_buton(View v){
        if(kalan_zaman == 0)
           kalan_zaman = 13;
        is_pause = true;
        timerHandler.removeCallbacks(timerRunnable);
        timerRunnable.run();


    }

    public void SoruGetir(int puan){
        Soru_Puan = puan;
        StringRequest jsonObjectRequest = new StringRequest(Request.Method.POST, soruUrl, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println(response.toString());
                System.out.println(response.toString());
                try{
                    JSONArray jsonarray = new JSONArray(response);
                    Random rand = new Random();
                    int boyut = jsonarray.length();
                    JSONObject soru = jsonarray.getJSONObject(rand.nextInt(boyut));
                    Soru.setText(soru.getString("Soru"));
                    CevapA.setText(soru.getString("a"));
                    CevapB.setText(soru.getString("b"));
                    CevapC.setText(soru.getString("c"));
                    CevapD.setText(soru.getString("d"));
                    cevap = soru.getString("Cvp");
                }catch(JSONException e){
                    //   e.printStackTrace();
                }
            }
        } , new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println(error.getMessage());
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> parametreler = new HashMap<String, String>();
                parametreler.put("puan", String.valueOf(Soru_Puan));
                return parametreler;
            }

        };

        requestQueue.add(jsonObjectRequest);

    }
  /*  public void puanEkle(final int puan){
        sharedPreferences = getSharedPreferences("oturumdurum",0);
        final int loginid = sharedPreferences.getInt("loginid",1);
        System.out.println(loginid);
        StringRequest jsonObjectRequest = new StringRequest(Request.Method.POST, soruUrl, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println(response.toString());
                try{
                    JSONArray jsonarray = new JSONArray(response);
                    Random rand = new Random();
                    int boyut = jsonarray.length();
                    JSONObject soru = jsonarray.getJSONObject(rand.nextInt(boyut));
                    Soru.setText(soru.getString("Soru"));
                    CevapA.setText(soru.getString("a"));
                    CevapB.setText(soru.getString("b"));
                    CevapC.setText(soru.getString("c"));
                    CevapD.setText(soru.getString("d"));
                    cevap = soru.getString("Cvp");
                }catch(JSONException e){
                    //   e.printStackTrace();
                }
            }
        } , new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                System.out.println(error.getMessage());
            }
        }) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> parametreler = new HashMap<String, String>();
                parametreler.put("puan", String.valueOf(puan));
                parametreler.put("id", String.valueOf(loginid));
                return parametreler;
            }

        };

        requestQueue.add(jsonObjectRequest);
    }*/

    public void showMyCustomAlertDialog() {
        // retrieve display dimensions
        Rect displayRectangle = new Rect();
        Window window = this.getWindow();
        window.getDecorView().getWindowVisibleDisplayFrame(displayRectangle);

// inflate and adjust layout
        LayoutInflater inflater = (LayoutInflater)this.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View layout = inflater.inflate(R.layout.custom_dialog, null);
        layout.setMinimumWidth((int)(displayRectangle.width() * 0.9f));
        layout.setMinimumHeight((int)(displayRectangle.height() * 0.3f));
        // dialog nesnesi oluştur ve layout dosyasına bağlan
        final Dialog dialog = new Dialog(this);
        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        dialog.setContentView(layout);

        // custom dialog elemanlarını tanımla - text, image ve button
        Button btnYenidenBasla = (Button) dialog.findViewById(R.id.button24);
        Button btnOyunuBirak = (Button) dialog.findViewById(R.id.button25);

        // tamam butonunun tıklanma olayları
        btnYenidenBasla.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(Yarisma.this,"deneme",Toast.LENGTH_SHORT).show();
                basildiMi = true;
            }
        });
        // iptal butonunun tıklanma olayları
        btnOyunuBirak.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                basildiMi = true;
                dialog.dismiss();
            }
        });
        dialog.setCancelable(false);
        dialog.show();




    }

}
