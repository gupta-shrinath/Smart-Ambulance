package in.edu.vpt.smartambulance;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

public class DoctorProfileActivity extends AppCompatActivity {
    private TextView name;
    private TextView hospital;
    private TextView mobile;
    private TextView mail_id;
    SessionManager sessionManager;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_doctor_profile);
        name=findViewById(R.id.text1);
        hospital=findViewById(R.id.text2);
        mail_id=findViewById(R.id.text3);
        mobile=findViewById(R.id.text4);
        sessionManager=new SessionManager(DoctorProfileActivity.this);
        name.setText(sessionManager.getNAME());
        hospital.setText(sessionManager.getHOSPITAL());
        mail_id.setText(sessionManager.getMAIL_ID());
        mobile.setText(sessionManager.getMOBILE());
        Log.i("DoctorProfileActivity.java","Name"+sessionManager.getNAME()+" Hospital"+sessionManager.getHOSPITAL()+" Car"+sessionManager.getCAR()+" Vehicle"+
                sessionManager.getVEHICLE()+" Mobile"+sessionManager.getMOBILE()+" aadhar"+sessionManager.getAADHAR());

    }
}
