package com.team.hbplay.bilgiyarisi;

/**
 * Created by TOSHIBA S70 on 16.10.2016.
 */

public class Uyeler {

    private int sira;
    private String kullaniciadi;
    private String puan;

    public Uyeler(int sira, String kullanici,String puan)
    {
        super();
        this.sira =  sira;
        this.kullaniciadi = kullanici;
        this.puan = puan;
    }

    public int getSira(){

        return sira;
    }

    public String getKullaniciadi(){

        return  kullaniciadi;
    }

    public String getPuan(){

        return puan;
    }

}
