package in.edu.vpt.smartambulance;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.Configuration;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import java.util.Locale;


public class LanguageActivity extends AppCompatActivity {
    private  Button English;
    private  Button Marathi;
    private  Button Hindi;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        loadLocale(LanguageActivity.this);
        setContentView(R.layout.activity_language);

        English = findViewById(R.id.en);
        Hindi = findViewById(R.id.hi);
        Marathi = findViewById(R.id.mr);
        English.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                setLocale("en", LanguageActivity.this);
                Intent i = new Intent(LanguageActivity.this, IntroActivity.class);
                startActivity(i);
                finish();
            }
        });
        Hindi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                setLocale("hi", LanguageActivity.this);
                Intent i = new Intent(LanguageActivity.this, IntroActivity.class);
                startActivity(i);
                finish();
            }
        });
        Marathi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                setLocale("mr", LanguageActivity.this);
                Intent i = new Intent(LanguageActivity.this, IntroActivity.class);
                startActivity(i);
                finish();
            }
        });

    }

    public  static void setLocale(String Lang,Context context)
    {
        Locale locale=new Locale(Lang);
        Locale.setDefault(locale);
        Configuration config=new Configuration();
        config.locale=locale;
        context.getResources().updateConfiguration(config,context.getResources().getDisplayMetrics());

        SharedPreferences.Editor editor=context.getSharedPreferences("Settings",MODE_PRIVATE).edit();
        editor.putString("My_Lang",Lang);
        editor.apply();
    }



    public  static  void loadLocale(Context context)
    {

        SharedPreferences prefs=context.getSharedPreferences("Settings",Activity.MODE_PRIVATE);
        String language=prefs.getString("My_Lang","");
        setLocale(language,context);


    }

}

