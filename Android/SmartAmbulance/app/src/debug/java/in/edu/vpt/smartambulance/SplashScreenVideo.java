package in.edu.vpt.smartambulance;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.media.MediaPlayer;
import android.net.Uri;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.VideoView;

public class SplashScreenVideo extends AppCompatActivity {
SessionManager session;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_splashscreenvideo);
        session=new SessionManager(getApplicationContext());
        VideoView videoview = (VideoView) findViewById(R.id.videoView);
        Uri uri = Uri.parse("android.resource://"+getPackageName()+"/"
                +R.raw.splashscreen);
        videoview.setVideoURI(uri);


        videoview.setOnCompletionListener(new MediaPlayer.OnCompletionListener() {
            @Override
            public void onCompletion(MediaPlayer mp) {
                if (isFinishing())
                    return;
                if (session.isLoggedIn()) {
                    if (session.getCAR() == "car")

                        startActivity(new Intent(SplashScreenVideo.this, DashboardDoctorActivity.class));

                    else
                    startActivity(new Intent(SplashScreenVideo.this, DashboardActivity.class));

                } else {

                    SharedPreferences sharedPreferences = getSharedPreferences("Settings", Context.MODE_PRIVATE);
                    String language = sharedPreferences
                            .getString("My_Lang", "");

                    if (language == "") {
                        startActivity(new Intent(SplashScreenVideo.this, LanguageActivity.class));
                        finish();
                    } else {


                        boolean slider = sharedPreferences
                                .getBoolean("My_Slider", false);

                        if (slider) {
                            startActivity(new Intent(SplashScreenVideo.this, LoginActivity.class));
                            finish();

                        } else {
                            startActivity(new Intent(SplashScreenVideo.this, IntroActivity.class));
                            finish();
                        }


                    }

                }
            }
        });

        videoview.start();
    }
}