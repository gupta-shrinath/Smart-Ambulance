package in  .edu.vpt.smartambulance;

import android.Manifest;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v4.content.LocalBroadcastManager;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import com.mukesh.OnOtpCompletionListener;
import com.mukesh.OtpView;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import static in.edu.vpt.smartambulance.OtpActivity.GetNumber;

public class VerifyOtpActivity extends AppCompatActivity implements View.OnClickListener,
        OnOtpCompletionListener {
    private Button validateButton;
    private OtpView otpView;
    private String otp;
    private String phonenumebr;
    private EditText messageedittext;


    ConnectionString cs = new ConnectionString();

    private final String CHECK_OTP = cs.getCS() + "/Mobile_Code/checkotp.php";

    private boolean doubleBackToExitPressedOnce;

    public static final int REQUEST_ID_MULTIPLE_PERMISSIONS = 1;

    private  BroadcastReceiver receiver;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_verifyotp);
        initializeUi();
        setListeners();
        messageedittext=findViewById(R.id.tv_message);
        if (checkAndRequestPermissions()) {
            // carry on the normal flow, as the case of  permissions  granted.
        }


        receiver = new BroadcastReceiver() {
            @Override
            public void onReceive(Context context, Intent intent) {
                if (intent.getAction().equalsIgnoreCase("otp")) {
                    final String message = intent.getStringExtra("message");
                    Toast.makeText(context, "message"+message, Toast.LENGTH_LONG).show();

                    otpView.setText(message);
                    messageedittext.setText(message);

                    //Do whatever you want with the code here
                }
            }
        };

    }

    @Override
    protected void onPause() {
        super.onPause();
        LocalBroadcastManager.getInstance(this).unregisterReceiver(receiver);
    }


    @Override
    protected void onPostResume() {
        LocalBroadcastManager.getInstance(this).registerReceiver(receiver, new IntentFilter("otp"));
        super.onPostResume();
    }



    @Override
    public void onClick(View v) {
        if (v.getId() == R.id.validate_button) {
            otp = otpView.getText().toString();
            phonenumebr = GetNumber(VerifyOtpActivity.this);

            checkotp(otp, phonenumebr);
            //Toast.makeText(this, otpView.getText(), Toast.LENGTH_SHORT).show();
        }
    }

    private void initializeUi() {
        otpView = findViewById(R.id.otp_view);
        validateButton = findViewById(R.id.validate_button);
    }

    private void setListeners() {
        validateButton.setOnClickListener(this);
        otpView.setOtpCompletionListener(this);
    }

    @Override
    public void onOtpCompleted(String otp) {
        // do Stuff
        //  Toast.makeText(this, "OnOtpCompletionListener called", Toast.LENGTH_SHORT).show();
    }

    public static void StoreOtp(String otp, Context context) {

        SharedPreferences.Editor editor = context.getSharedPreferences("num", MODE_PRIVATE).edit();
        editor.putString("otp", otp);
        editor.apply();
    }

    public static String GetOtp(Context context) {

        SharedPreferences prefs = context.getSharedPreferences("num", Activity.MODE_PRIVATE);
        String otp = prefs.getString("otp", "otp");
        return otp;


    }


    private void checkotp(String otpnumber, String phone) {


        class RegisterUser1 extends AsyncTask<String, Void, String> {
            DataReader ruc = new DataReader();
            ProgressDialog loading;


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(VerifyOtpActivity.this, "Please Wait", null, true, true);

            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                Toast.makeText(getApplicationContext(), s, Toast.LENGTH_LONG).show();

                if (s.equalsIgnoreCase("success")) {
                    StoreOtp(otp, VerifyOtpActivity.this);

                    //  Toast.makeText(VerifyOtpActivity.this, "Information Updated on Server", Toast.LENGTH_LONG).show();
                    Intent intent = new Intent(VerifyOtpActivity.this, ForgotPasswordActivity.class);
                    startActivity(intent);


                } else {
                    AlertDialog.Builder builder;

                    builder = new AlertDialog.Builder(VerifyOtpActivity.this);

                    builder.setTitle("Error")
                            .setMessage("Verification of OTP Failed !")

                            .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {
                                    // continue with delete
                                }
                            })
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .show();
                }
            }


            @Override
            protected String doInBackground(String... params) {
                HashMap<String, String> data = new HashMap<String, String>();
                data.put("otp", params[1]);

                data.put("phone", params[0]);

                String result = ruc.sendPostRequest(CHECK_OTP, data);

                return result;

            }
        }

        RegisterUser1 ru = new RegisterUser1();
        ru.execute(otpnumber, phone);
    }


    private  boolean checkAndRequestPermissions() {
        int permissionSendMessage = ContextCompat.checkSelfPermission(this,
                Manifest.permission.SEND_SMS);

        int receiveSMS = ContextCompat.checkSelfPermission(this,
                Manifest.permission.RECEIVE_SMS);

        int readSMS = ContextCompat.checkSelfPermission(this,
                Manifest.permission.READ_SMS);
        List<String> listPermissionsNeeded = new ArrayList<>();

        if (receiveSMS != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(Manifest.permission.RECEIVE_MMS);
        }
        if (readSMS != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(Manifest.permission.READ_SMS);
        }
        if (permissionSendMessage != PackageManager.PERMISSION_GRANTED) {
            listPermissionsNeeded.add(Manifest.permission.SEND_SMS);
        }
        if (!listPermissionsNeeded.isEmpty()) {
            ActivityCompat.requestPermissions(this,
                    listPermissionsNeeded.toArray(new String[listPermissionsNeeded.size()]),
                    REQUEST_ID_MULTIPLE_PERMISSIONS);
            return false;
        }
        return true;
    }
}
