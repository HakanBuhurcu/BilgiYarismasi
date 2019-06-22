package com.team.hbplay.bilgiyarisi;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;

public class Acilis extends AppCompatActivity {

    SharedPreferences girisdurum;
    SharedPreferences.Editor editor;

    Intent i1,i2,i3,i5;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        girisdurum = getSharedPreferences("oturumdurum",0);
        int oturumdegeri = girisdurum.getInt("oturumdeger",1);


            if (oturumdegeri == 2) {
                i1 = new Intent(Acilis.this, Giris.class);
                startActivity(i1);
            } else if (oturumdegeri == 1) {
                i2 = new Intent(Acilis.this, Kayit.class);
                startActivity(i2);

            } else if (oturumdegeri == 3) {
                i3 = new Intent(Acilis.this, Login.class);
                startActivity(i3);

            }



    }
}
