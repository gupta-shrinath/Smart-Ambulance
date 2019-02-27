package in.edu.vpt.smartambulance;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;

public class DashboardActivity extends AppCompatActivity {

    private ImageView emergency;
    private ImageView logout;
    private ImageView profile;
    SessionManager session;

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finishAffinity();
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);


        setContentView(R.layout.activity_dashboard);
        session=new SessionManager(getApplicationContext());

        emergency=findViewById(R.id.iv_emergency);
        emergency.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(DashboardActivity.this, EnterPatientDetailsActivity.class);
                startActivity(i);
            }
        });
        Log.i("LOGIN ACTIVITY","ID:"+session.getID()+" NAME:"+session.getNAME()+" HOSPITAL:"+session.getHOSPITAL()+" VEHICLE:"+session.getVEHICLE()
                +" MOBILE:"+session.getMOBILE()+" CAR:"+session.getCAR()+" AADHAR:"+session.getAADHAR()+" MAIL_ID:"+session.getMAIL_ID());



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
                startActivity(new Intent(DashboardActivity.this, DriverProfileActivity.class));
            }
        });

}
}
