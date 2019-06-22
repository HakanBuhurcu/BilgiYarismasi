package com.team.hbplay.bilgiyarisi;

import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.List;

/**
 * Created by TOSHIBA S70 on 16.10.2016.
 */

public class OzelAdaptor extends BaseAdapter {

    private LayoutInflater inflater;
    private List<Uyeler> uyeListe;

    public OzelAdaptor(Activity activity, List<Uyeler> uyeler) {
        inflater=(LayoutInflater)activity.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        uyeListe = uyeler;
    }

    @Override
    public int getCount() {
        return  uyeListe.size();
    }

    @Override
    public Object getItem(int position) {
        return uyeListe.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {

        View satirView = inflater.inflate(R.layout.satir_layout,null);
        TextView sira = (TextView)satirView.findViewById(R.id.textView10);
        TextView kullaniciad = (TextView)satirView.findViewById(R.id.textView11);
        TextView puan = (TextView)satirView.findViewById(R.id.textView12);

        Uyeler uye = uyeListe.get(position);
        sira.setText(String.valueOf(uye.getSira()) + "-");
        kullaniciad.setText(uye.getKullaniciadi());
        puan.setText(uye.getPuan());

        return satirView;
    }
}
