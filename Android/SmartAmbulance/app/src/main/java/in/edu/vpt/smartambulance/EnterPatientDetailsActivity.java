package in.edu.vpt.smartambulance;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Build;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.util.HashMap;

public class EnterPatientDetailsActivity extends AppCompatActivity {

    private EditText patientname;
    private EditText patientage;
    private EditText condition;
    private Button submit;
    private String p_name;
    private String p_age;
    private String p_con;
    ConnectionString cs = new ConnectionString();

    private final String SEND_URL = cs.getCS() + "/Mobile_Code/send_patient_details.php";
    public String message;
    private final String SEND_NOTI_URL = cs.getCS() + "/Mobile_Code/send.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_enter_patient_details);
        patientname=findViewById(R.id.edit_text1);
        patientage=findViewById(R.id.edit_text2);
        condition=findViewById(R.id.edit_text3);
        submit=findViewById(R.id.button);
        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                p_name= patientname.getText().toString().trim();
                p_age = patientage.getText().toString().trim();
                p_con=condition.getText().toString().trim();
                message="Patient Name "+p_name+"\nPatient Age"+p_age+"\nPatient Emergency Condition"+p_con;
                sendpatientdetails(p_name,p_age,p_con);

            }
        });
    }
    private void sendpatientdetails(final String pname, final String page,final  String pcondition) {

        class RegisterUser extends AsyncTask<String, Void, String> {
            ProgressDialog loading;
            DataReader ruc = new DataReader();


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(EnterPatientDetailsActivity.this, null, "Please Wait", true, false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                 Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
                // String s = result.trim();
                //loadingDialog.dismiss();
                if (s.equalsIgnoreCase("success")) {
                   /// sendnotification(message);
                        startActivity(new Intent(EnterPatientDetailsActivity.this,MapsActivity.class));
                } else {

                    //Toast.makeText(getApplicationContext(), "Invalid User Name or Password", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            protected String doInBackground(String... params) {

                HashMap<String, String> data = new HashMap<String, String>();
                data.put("name", params[0]);
                data.put("age", params[1]);
                data.put("condition", params[2]);
                String result = ruc.sendPostRequest(SEND_URL, data);

                return result;
            }
        }

        RegisterUser ru = new RegisterUser();
        ru.execute(pname, page, pcondition);

    }

    private void sendnotification(final String message) {

        class RegisterUser extends AsyncTask<String, Void, String> {
            ProgressDialog loading;
            DataReader ruc = new DataReader();


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(EnterPatientDetailsActivity.this, null, "Please Wait", true, false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                loading.dismiss();
                Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
                // String s = result.trim();
                //loadingDialog.dismiss();
                if (s.equalsIgnoreCase("success")) {
                    startActivity(new Intent(EnterPatientDetailsActivity.this,MapsActivity.class));

                } else {
                    AlertDialog.Builder builder;
                    if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
                        builder = new AlertDialog.Builder(EnterPatientDetailsActivity.this, android.R.style.Theme_DeviceDefault_Light_Dialog_Alert);
                    } else {
                        builder = new AlertDialog.Builder(EnterPatientDetailsActivity.this);
                    }
                    builder.setTitle(R.string.error)
                            .setMessage(R.string.failnotifi)
                            .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                                public void onClick(DialogInterface dialog, int which) {
                                    // continue with delete
                                }
                            })
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .show();
                    //Toast.makeText(this, "PLEASE SELECT USER TYPE", Toast.LENGTH_LONG).show();

                    //Toast.makeText(getApplicationContext(), "Invalid User Name or Password", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            protected String doInBackground(String... params) {

                HashMap<String, String> data = new HashMap<String, String>();
                data.put("message", params[0]);
                String result = ruc.sendPostRequest(SEND_NOTI_URL, data);

                return result;
            }
        }

        RegisterUser ru = new RegisterUser();
        ru.execute(message);

    }


}
