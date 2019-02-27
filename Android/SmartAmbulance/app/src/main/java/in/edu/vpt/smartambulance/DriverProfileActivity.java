package in.edu.vpt.smartambulance;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

public class DriverProfileActivity extends AppCompatActivity {
    private TextView name;
    private TextView hospital;
    private TextView car;
    private TextView vehicle;
    private TextView mobile;
    private TextView aadhar;
    SessionManager sessionManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_driver_profile);
        name=findViewById(R.id.text1);
        hospital=findViewById(R.id.text2);
        car=findViewById(R.id.text3);
        vehicle=findViewById(R.id.text4);
        mobile=findViewById(R.id.text5);
        aadhar=findViewById(R.id.text6);
        sessionManager=new SessionManager(DriverProfileActivity.this);
        name.setText(sessionManager.getNAME());
        hospital.setText(sessionManager.getHOSPITAL());
        car.setText(sessionManager.getCAR());
        vehicle.setText(sessionManager.getVEHICLE());
        mobile.setText(sessionManager.getMOBILE());
        aadhar.setText(sessionManager.getAADHAR());
        Log.i("DriverProfileActivity.java","Name"+sessionManager.getNAME()+" Hospital"+sessionManager.getHOSPITAL()+" Car"+sessionManager.getCAR()+" Vehicle"+
                sessionManager.getVEHICLE()+" Mobile"+sessionManager.getMOBILE()+" aadhar"+sessionManager.getAADHAR());

    }
}
