package in.edu.vpt.smartambulance;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;

public class DashboardDoctorActivity extends AppCompatActivity {

    private ImageView logout;
    private ImageView profile;
    private ImageView notification;
    SessionManager session;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dashboard_doctor);
        session=new SessionManager(getApplicationContext());
        logout=findViewById(R.id.iv_logout);
        logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                session.logoutUser();

            }
        });

        profile=findViewById(R.id.iv_profile);
        profile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(DashboardDoctorActivity.this, DoctorProfileActivity.class));
            }
        });

        notification=findViewById(R.id.iv_notification);
        notification.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });

        Log.i("LOGIN ACTIVITY","ID:"+session.getID()+" NAME:"+session.getNAME()+" HOSPITAL:"+session.getHOSPITAL()+" VEHICLE:"+session.getVEHICLE()
                +" MOBILE:"+session.getMOBILE()+" CAR:"+session.getCAR()+" AADHAR:"+session.getAADHAR()+" MAIL_ID:"+session.getMAIL_ID());

    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finishAffinity();
    }
}
