package com.team.hbplay.bilgiyarisi;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;

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

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
/**
 * Created by TOSHIBA S70 on 2.10.2016.
 */

public class Giris extends AppCompatActivity {
    ListView customListView;
    SharedPreferences sharedPreferences;
    OzelAdaptor adaptor;
    RequestQueue requestQueue;
    List<Uyeler> uyelerList;
    TextView kuadi,siralama,puan,elli,ybes,pas,cift;
    Button basla;
    int loginid;
    private static final String gosterurl = "http://192.168.43.174/uyeler.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.girissayfa);
        kuadi = (TextView)findViewById(R.id.textView);
        siralama = (TextView)findViewById(R.id.textView4);
        puan = (TextView)findViewById(R.id.textView3);
        elli = (TextView)findViewById(R.id.textView6);
        ybes = (TextView)findViewById(R.id.textView7);
        pas = (TextView)findViewById(R.id.textView8);
        cift = (TextView)findViewById(R.id.textView9);
        basla = (Button)findViewById(R.id.button7);
        uyelerList = new ArrayList<Uyeler>();
        customListView = (ListView)findViewById(R.id.listview);
        requestQueue = Volley.newRequestQueue(getApplicationContext());

        sharedPreferences = getSharedPreferences("oturumdurum",0);
        loginid = sharedPreferences.getInt("loginid",1);
        System.out.println(loginid);

        StringRequest jsonObjectRequest = new StringRequest(Request.Method.POST, gosterurl, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println(response.toString());
                try{
                    JSONArray jsonarray = new JSONArray(response);
                    int boyut = jsonarray.length();
                    JSONObject kullanici = jsonarray.getJSONObject(boyut - 1);
                    String kullaniciadi = kullanici.getString("kullaniciadi");

                    kuadi.setText(kullaniciadi);
                    puan.setText(kullanici.getString("puan"));
                    elli.setText(kullanici.getString("elli"));
                    ybes.setText(kullanici.getString("ybes"));
                    pas.setText(kullanici.getString("pas"));
                    cift.setText(kullanici.getString("cift"));

                    for (int i = 0; i < boyut - 1 ; i++){
                        JSONObject veri = jsonarray.getJSONObject(i);
                        String kadi = veri.getString("kullaniciadi");
                        Uyeler yeniuye = new Uyeler(i + 1,kadi,veri.getString("puani"));
                        uyelerList.add(yeniuye);

                        if(kullaniciadi.equals(kadi)){
                            siralama.setText(String.valueOf(i + 1));
                        }
                    }

                    adaptor = new OzelAdaptor(Giris.this,uyelerList);
                    customListView.setAdapter(adaptor);


                }catch(JSONException e){
                    e.printStackTrace();
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
                parametreler.put("id", String.valueOf(loginid));
                return parametreler;
            }

        };

        requestQueue.add(jsonObjectRequest);


        basla.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
               Intent sorusayfa = new Intent(Giris.this, Yarisma.class);
                startActivity(sorusayfa);
            }
        });

    }



}
