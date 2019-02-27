package in.edu.vpt.smartambulance;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.util.HashMap;

import static in.edu.vpt.smartambulance.OtpActivity.GetNumber;
import static in.edu.vpt.smartambulance.VerifyOtpActivity.GetOtp;

public class ForgotPasswordActivity extends AppCompatActivity {

    private boolean doubleBackToExitPressedOnce;
    ConnectionString cs = new ConnectionString();

    private final String SET_PASS = cs.getCS() + "/Mobile_Code/VerifyOtpActivity.php";


    private EditText pass;
    private Button submit;
    private String password;
    private String otp;
    private String number;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_forgot_password);
        pass=findViewById(R.id.password);
        submit=findViewById(R.id.submit1);
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                    password=pass.getText().toString();
                    otp=GetOtp(ForgotPasswordActivity.this);
                    number=GetNumber(ForgotPasswordActivity.this);

                    if(password.length()<8)
                    {
                        AlertDialog.Builder builder;

                        builder = new AlertDialog.Builder(ForgotPasswordActivity.this);

                        builder.setTitle(R.string.error)
                                .setMessage(R.string.lenofpass)
                                .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                                    public void onClick(DialogInterface dialog, int which) {
                                        // continue with delete
                                    }
                                })
                                .setIcon(android.R.drawable.ic_dialog_alert)
                                .show();

                    }
                else {
                        forpass(number, password, otp);
                    }
            }
        });
    }

    private void forpass(String phone,String pass,String otp) {


        class RegisterUser1 extends AsyncTask<String, Void, String> {
            DataReader ruc = new DataReader();
            ProgressDialog loading;


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(ForgotPasswordActivity.this, getText(R.string.wait),null, true, true);

            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
//                Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();

                Intent intent=new Intent(ForgotPasswordActivity.this,LoginActivity.class);
                startActivity(intent);

                if(s.equalsIgnoreCase("success"))
                {  AlertDialog.Builder builder;

                    builder = new AlertDialog.Builder(ForgotPasswordActivity.this);

                    builder.setTitle(R.string.success)
                            .setMessage(R.string.resetpas)
                            .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {
                                    // continue with delete
                                }
                            })
                            .setIcon(R.drawable.ic_success)
                            .show();

                }else
                {
                    AlertDialog.Builder builder;

                    builder = new AlertDialog.Builder(ForgotPasswordActivity.this);

                    builder.setTitle(R.string.error)
                            .setMessage(R.string.faresetpa)
                            .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {
                                    // continue with delete
                                }
                            })
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .show();

                    //Toast.makeText(ForgotPasswordActivity.this,"number"+number+"otp"+"password"+password,Toast.LENGTH_SHORT).show();
                    //Toast.makeText(getApplicationContext(), "Request Not Send. Try Again!", Toast.LENGTH_LONG).show();
                }
            }


            @Override
            protected String doInBackground(String... params) {
                HashMap<String, String> data = new HashMap<String,String>();

                    data.put("phone",params[0]);

                data.put("pass",params[1]);

                data.put("otp",params[2]);

                String result = ruc.sendPostRequest(SET_PASS,data);

                return  result;

            }
        }

        RegisterUser1 ru = new RegisterUser1();
        ru.execute(phone,pass,otp);
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExitPressedOnce) {
            finishAffinity();
            return;
        }

        this.doubleBackToExitPressedOnce = true;
        Toast.makeText(this, R.string.pressback, Toast.LENGTH_SHORT).show();

        new Handler().postDelayed(new Runnable() {

            @Override
            public void run() {
                doubleBackToExitPressedOnce = false;
            }
        }, 2000);
    }
}
