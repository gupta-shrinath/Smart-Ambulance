package in.edu.vpt.smartambulance;

import android.Manifest;
import android.app.AlertDialog;
import android.content.Context;
import android.content.res.Configuration;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Handler;
import android.support.annotation.NonNull;
import android.support.v4.app.ActivityCompat;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.InputType;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;
import static in.edu.vpt.smartambulance.LanguageActivity.loadLocale;


public class LoginActivity extends AppCompatActivity implements AdapterView.OnItemSelectedListener {

    private final static int MY_PERMISSION_STORAGE = 102;
    private EditText mobile;
    private EditText password;
    public Spinner spinner;
    public String passwordInput;
    public String mobileInput;
    private boolean loggedIn = false;
    public String usertype;
    public int pos;
    private CheckBox showPassword;
    private TextView forgotpass;
    ConnectionString cs = new ConnectionString();
    String myJSON;
    String myDriverJSON;
    private static final String TAG_RESULTS = "result";
    private static final String TAG_ID = "a_id";
    private static final String TAG_NAME = "name";
    private static final String TAG_HOSPITAL = "hospital";
    private static final String TAG_MOBILE = "mobile";
    private static final String TAG_VEHICLE = "vehicle";
    private static final String TAG_CAR = "car";
    private static final String TAG_AADHAR = "aadhar";


    private static final String TAG_DOC_ID = "doc_id";
    private static final String TAG_DOC_NAME = "doc_name";
    private static final String TAG_DOC_HOSPITAL = "doc_hos";
    private static final String TAG_DOC_MOBILE = "doc_mob";
    private static final String TAG_DOC_MAIL_ID = "doc_mail_id";


    SessionManager session;
    private final String LOGIN_URL = cs.getCS() +"Mobile_Code/login_driver.php";
    private final String LOGIN_URL1 = cs.getCS() +"Mobile_Code/fetch_driver_details.php";
    private final String DOC_LOGIN_URL = cs.getCS() +"Mobile_Code/login_doctor.php";
    private final String DOC_LOGIN_URL1 = cs.getCS() +"Mobile_Code/fetch_doctor_details.php";

    String driver_id, driver_name, driver_hospital, driver_mobile, driver_vehicle, driver_car, driver_aadhar;
    String doctor_id, doctor_name, doctor_hospital, doctor_mobile, doctor_mail_id;

    ArrayList<HashMap<String, String>> personList;
    JSONArray peoples = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        loadLocale(LoginActivity.this);

        setContentView(R.layout.activity_login);

            session = new SessionManager(getApplicationContext());


            spinner = findViewById(R.id.spinner);
            forgotpass = findViewById(R.id.txt_forpass);
            ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this, R.array.User, R.layout.spinner_center_item);
            adapter.setDropDownViewResource(R.layout.spinner_center_item);
            spinner.setAdapter(adapter);
            spinner.setOnItemSelectedListener(this);
            mobile = findViewById(R.id.user_name);
            password = findViewById(R.id.Password);


            showPassword = (CheckBox) findViewById(R.id.checkBox);
            showPassword.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
                @Override
                public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                    if (isChecked) {
                        password.setInputType(InputType.TYPE_CLASS_TEXT | InputType.TYPE_TEXT_VARIATION_VISIBLE_PASSWORD);
                    } else {
                        password.setInputType(InputType.TYPE_CLASS_TEXT | InputType.TYPE_TEXT_VARIATION_PASSWORD);
                    }
                }
            });
            forgotpass.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    Intent intent = new Intent(LoginActivity.this, OtpActivity.class);
                    startActivity(intent);
                }
            });


            final Button loginbn = findViewById(R.id.login_bn);
            loginbn.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                        if (!validatePassword() && !isValidMobile()) {
                            if (!isValidUser())
                                return;
                        } else {
                            isValidUser();
                            isValidMobile();
                            if (pos == 2) {
                                mobileInput = mobile.getText().toString().trim();
                                passwordInput = password.getText().toString().trim();
                                login_driver(mobileInput, passwordInput);
                            } else {
                                if (pos == 1) {
                                    mobileInput = mobile.getText().toString().trim();
                                    passwordInput = password.getText().toString().trim();
                                    login_doctor(mobileInput, passwordInput);


                                }

                            }
                        }
                    }

            });


    }


    boolean doubleBackToExitPressedOnce = false;

    @Override
    public void onConfigurationChanged(Configuration newConfig) {
        // refresh your views here
        super.onConfigurationChanged(newConfig);
    }

    @Override
    public void onBackPressed() {
        if (doubleBackToExitPressedOnce) {
            super.onBackPressed();
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


    private boolean validatePassword() {
        passwordInput = password.getText().toString().trim();

        if (passwordInput.isEmpty()) {
            password.setError(getText(R.string.field));
            return false;
        } else {
            password.setError(null);
            return true;
        }
    }

    private boolean isValidMobile() {
        mobileInput = mobile.getText().toString().trim();

        //Toast.makeText(this,mobileInput,Toast.LENGTH_SHORT).show();


        if (mobileInput.isEmpty()) {
            mobile.setError(getText(R.string.field));
            return false;
        } else {
            if (mobileInput.length() > 10 || mobileInput.length() < 10) {
                // if(phone.length() != 10) {

                mobile.setError(getText(R.string.invaildmobile));
            }
            return false;
        }

    }

    private boolean isValidUser() {
        pos = spinner.getSelectedItemPosition();
        if (pos != 0) {
            usertype = spinner.getSelectedItem().toString();

            return true;

        } else {
            if (pos == 0) {
                AlertDialog.Builder builder;
                if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.LOLLIPOP) {
                    builder = new AlertDialog.Builder(this, android.R.style.Theme_DeviceDefault_Light_Dialog_Alert);
                } else {
                    builder = new AlertDialog.Builder(this);
                }
                builder.setTitle(R.string.invalid)
                        .setMessage(R.string.alertuser)
                        .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                            public void onClick(DialogInterface dialog, int which) {
                                // continue with delete
                            }
                        })
                        .setIcon(android.R.drawable.ic_dialog_alert)
                        .show();
                //Toast.makeText(this, "PLEASE SELECT USER TYPE", Toast.LENGTH_LONG).show();

            }
            return false;

        }

    }



    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }


    @Override
    protected void onResume() {
        super.onResume();




    }


    private void login_driver(final String mobile, final String password) {

        class RegisterUser extends AsyncTask<String, Void, String> {
            ProgressDialog loading;
            DataReader ruc = new DataReader();


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(LoginActivity.this, null, getText(R.string.wait), true, false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
            //    Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
                // String s = result.trim();
                //loadingDialog.dismiss();
                if (s.equalsIgnoreCase("success")) {
                    get_driver_details(mobile, password);
                } else {

                    new AlertDialog.Builder(LoginActivity.this)
                            .setTitle(R.string.faillog)
                            .setMessage(R.string.invalidlo)
                            .setPositiveButton(R.string.ok, new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                 dialog.dismiss();                            }
                            })
                            .create().show();
                    //Toast.makeText(getApplicationContext(), "Invalid User Name or Password", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            protected String doInBackground(String... params) {

                HashMap<String, String> data = new HashMap<String, String>();
                data.put("username", params[0]);
                data.put("password", params[1]);

                String result = ruc.sendPostRequest(LOGIN_URL, data);

                return result;
            }
        }

        RegisterUser ru = new RegisterUser();
        ru.execute(mobile, password);


    }

    private void get_driver_details(String username, String password) {
        class RegisterUser extends AsyncTask<String, Void, String> {
            ProgressDialog loading;
            DataReader ruc = new DataReader();


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(LoginActivity.this, null, "Please Wait", true, false);
            }

            @Override
            protected void onPostExecute(String result) {
                //super.onPostExecute(s);
                loading.dismiss();
                myDriverJSON = result;

                GetDriverJSON();
                session.createLoginSession(driver_id, driver_name, driver_hospital, driver_vehicle, driver_mobile, driver_car, driver_aadhar);
                Intent intent = new Intent(LoginActivity.this, DashboardActivity.class);
                LoginActivity.this.finish();
                startActivity(intent);
            }

            @Override
            protected String doInBackground(String... params) {

                HashMap<String, String> data = new HashMap<String, String>();
                data.put("username", params[0]);
                data.put("password", params[1]);

                String result = ruc.sendPostRequest(LOGIN_URL1, data);

                return result;
            }
        }

        RegisterUser ru = new RegisterUser();
        ru.execute(username, password);
    }


    protected void GetDriverJSON() {
        try {
            JSONObject jsonObj = new JSONObject(myDriverJSON);
            peoples = jsonObj.getJSONArray(TAG_RESULTS);

            for (int i = 0; i < peoples.length(); i++) {
                JSONObject c = peoples.getJSONObject(i);
                driver_id = c.getString(TAG_ID);
                driver_name = c.getString(TAG_NAME);
                driver_hospital = c.getString(TAG_HOSPITAL);
                driver_aadhar = c.getString(TAG_AADHAR);
                driver_car = c.getString(TAG_CAR);
                driver_mobile = c.getString(TAG_MOBILE);
                driver_vehicle = c.getString(TAG_VEHICLE);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }


    private void login_doctor(final String mobile,final String password)
    {
        class RegisterUser extends AsyncTask<String, Void, String> {
            ProgressDialog loading;
            DataReader ruc = new DataReader();


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(LoginActivity.this, null, "Please Wait", true, false);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
               //  Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
                // String s = result.trim();
                //loadingDialog.dismiss();
                if (s.equalsIgnoreCase("success")) {
                    get_doctor_details(mobile, password);
                } else {

                    new AlertDialog.Builder(LoginActivity.this)
                            .setTitle(R.string.faillog)
                            .setMessage(R.string.invalidlo)
                            .setPositiveButton(R.string.ok, new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                    dialog.dismiss();                            }
                            })
                            .create().show();
                    //Toast.makeText(getApplicationContext(), "Invalid User Name or Password", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            protected String doInBackground(String... params) {

                HashMap<String, String> data = new HashMap<String, String>();
                data.put("username", params[0]);
                data.put("password", params[1]);

                String result = ruc.sendPostRequest(DOC_LOGIN_URL, data);

                return result;
            }
        }

        RegisterUser ru = new RegisterUser();
        ru.execute(mobile, password);


    }
    private void get_doctor_details(String username, String password) {
        class RegisterUser extends AsyncTask<String, Void, String> {
            ProgressDialog loading;
            DataReader ruc = new DataReader();


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(LoginActivity.this, null, getText(R.string.wait), true, true);
            }

            @Override
            protected void onPostExecute(String result) {
                //super.onPostExecute(s);
                loading.dismiss();
                myJSON = result;
                GetDoctorJSON();
                session.createDoctorLoginSession(doctor_id,doctor_name,doctor_hospital,doctor_mobile,doctor_mail_id );
            Intent intent = new Intent(LoginActivity.this, DashboardDoctorActivity.class);
            LoginActivity.this.finish();
            startActivity(intent);
        }

        @Override
            protected String doInBackground(String... params) {

                HashMap<String, String> data = new HashMap<String, String>();
                data.put("username", params[0]);
                data.put("password", params[1]);

                String result = ruc.sendPostRequest(DOC_LOGIN_URL1, data);

                return result;
            }
        }

        RegisterUser ru = new RegisterUser();
        ru.execute(username, password);
    }

    protected void GetDoctorJSON() {
        try {
            JSONObject jsonObj = new JSONObject(myJSON);
            peoples = jsonObj.getJSONArray(TAG_RESULTS);

            for (int i = 0; i < peoples.length(); i++) {
                JSONObject c = peoples.getJSONObject(i);
                doctor_id = c.getString(TAG_DOC_ID);
                doctor_name = c.getString(TAG_DOC_NAME);
                doctor_hospital = c.getString(TAG_DOC_HOSPITAL);
                doctor_mobile = c.getString(TAG_DOC_MOBILE);
                doctor_mail_id = c.getString(TAG_DOC_MAIL_ID);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

    }
    protected boolean isOnline() {

        ConnectivityManager cm = (ConnectivityManager)getSystemService(Context.CONNECTIVITY_SERVICE);

        NetworkInfo netInfo = cm.getActiveNetworkInfo();

        if (netInfo != null && netInfo.isConnectedOrConnecting()) {

            return true;

        } else {

            return false;

        }

    }

}





