package in.edu.vpt.smartambulance;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.util.HashMap;

public class OtpActivity extends AppCompatActivity {

    private EditText phonenumber;
    private Button sendotp;
    public  String number;

    ConnectionString cs = new ConnectionString();

    private final String SEND_OTP = cs.getCS() + "/Mobile_Code/sendotp.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_otp);
        phonenumber=findViewById(R.id.password);
        sendotp=findViewById(R.id.submit1);
       sendotp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                number = phonenumber.getText().toString();
                if (!isValidMobile()) {
                    sendotp(number);
                }

            }
       });

    }
    private boolean isValidMobile() {

        //Toast.makeText(this,mobileInput,Toast.LENGTH_SHORT).show();


        if (number.isEmpty()) {
            phonenumber.setError(getText(R.string.field));
            return false;
        } else {
            if (phonenumber.length() > 10 || phonenumber.length() < 10) {
                // if(phone.length() != 10) {

                phonenumber.setError(getText(R.string.invaildmobile));
            }
            return false;
        }


    }


    public  static void StoreNumber(String number, Context context)
    {

        SharedPreferences.Editor editor=context.getSharedPreferences("num",MODE_PRIVATE).edit();
        editor.putString("number",number);
        editor.apply();
    }

    public  static  String GetNumber(Context context)
    {

        SharedPreferences prefs=context.getSharedPreferences("num", Activity.MODE_PRIVATE);
        String otp=prefs.getString("number","number");
        return otp;


    }
    private void sendotp(String phone) {


        class RegisterUser1 extends AsyncTask<String, Void, String> {
            DataReader ruc = new DataReader();
            ProgressDialog loading;


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(OtpActivity.this, getText(R.string.wait),getText(R.string.sendotp), true, true);

            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
               Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();


                if(s.equalsIgnoreCase("failure"))
                {
                    AlertDialog.Builder builder;

                    builder = new AlertDialog.Builder(OtpActivity.this);

                builder.setTitle(R.string.error)
                        .setMessage(R.string.failotp)
                        .setPositiveButton(R.string.ok, new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {
                                // continue with delete
                            }
                        })
                        .setIcon(android.R.drawable.ic_dialog_alert)
                        .show();

               // Toast.makeText(getApplicationContext(), "Request Not Send. Try Again!", Toast.LENGTH_LONG).show();
                }
                else
                {

                    StoreNumber(number, OtpActivity.this);
                    //Toast.makeText(getApplicationContext(), "Information Updated on Server", Toast.LENGTH_LONG).show();


                    Intent intent=new Intent(OtpActivity.this, VerifyOtpActivity.class);
                    startActivity(intent);

                }
            }


            @Override
            protected String doInBackground(String... params) {
                HashMap<String, String> data = new HashMap<String,String>();

                data.put("phone",params[0]);

                String result = ruc.sendPostRequest(SEND_OTP,data);

                return  result;

            }
        }

        RegisterUser1 ru = new RegisterUser1();
        ru.execute(phone);
    }

}
