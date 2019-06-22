package com.team.hbplay.bilgiyarisi;

import android.content.SharedPreferences;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

/**
 * Created by TOSHIBA S70 on 2.10.2016.
 */

public class Kayit extends AppCompatActivity {

    Button uyeol,hesapvar;
    SharedPreferences oturumdurumu;
    SharedPreferences.Editor editor;
    EditText kullaniciadi,mail,sifre,tsifre;
    RequestQueue requestQueue;
    private static final String ekleUrl = "http://192.168.43.174/uyeekle.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
      // requestWindowFeature(Window.FEATURE_NO_TITLE);
       // getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.kayitsayfa);

        uyeol = (Button)findViewById(R.id.button);
     //  hesapvar = (Button)findViewById(R.id.button2);
        kullaniciadi = (EditText)findViewById(R.id.editText);
        mail = (EditText)findViewById(R.id.editText2);
        sifre = (EditText)findViewById(R.id.editText4);
        tsifre = (EditText)findViewById(R.id.editText3);

        requestQueue = Volley.newRequestQueue(getApplicationContext());

        uyeol.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {


                if (sifre.getText().toString().equals(tsifre.getText().toString())) {
                    StringRequest request = new StringRequest(Request.Method.POST, ekleUrl, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            System.out.println(response.toString());
                            String gelenid = response.substring(1,response.length() - 1);
                            int loginid = Integer.valueOf(gelenid);
                            System.out.println(loginid);
                            oturumdurumu = getSharedPreferences("oturumdurum",0);
                            editor = oturumdurumu.edit();
                            editor.putInt("oturumdeger",2);
                            editor.putInt("loginid",loginid);
                            editor.commit();

                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            System.out.println(error.getMessage());
                        }
                    }) {
                        @Override
                        protected Map<String, String> getParams() throws AuthFailureError {
                            Map<String, String> parametreler = new HashMap<String, String>();
                            parametreler.put("kullaniciadi", kullaniciadi.getText().toString());
                            parametreler.put("mail", mail.getText().toString());
                            parametreler.put("sifre", sifre.getText().toString());

                            return parametreler;
                        }
                    };
                    requestQueue.add(request);

                    Toast.makeText(Kayit.this, "BAŞARIYLA KAYDOLDUNUZ", Toast.LENGTH_SHORT).show();
                    Intent Gecis = new Intent(Kayit.this,Giris.class);
                    startActivity(Gecis);
                }
                else
                    Toast.makeText(Kayit.this, "YAZDIĞINIZ ŞİFRELER EŞLEŞMİYOR LÜTFEN DÜZELTİP TEKRAR DENEYİNİZ", Toast.LENGTH_SHORT).show();

            }

        });

    }

    public void login_tikla(View v){
        Intent logGecis = new Intent(Kayit.this,Login.class);
        startActivity(logGecis);
    }
}
