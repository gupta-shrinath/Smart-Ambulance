package in.edu.vpt.smartambulance;

import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageInfo;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;

public class SplashScreen extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setTheme(R.style.Theme_AppCompat_Light_NoActionBar);
        setContentView(R.layout.activity_splashscreen);
        Handler handler = new Handler();
        handler.postDelayed(new Runnable() {

            @Override
            public void run() {

                Intent intent = new Intent(SplashScreen.this, LoginActivity.class);
                startActivity(intent);

                finish();
            }
        }, 2500);


    }


}



