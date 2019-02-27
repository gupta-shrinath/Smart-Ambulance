package in.edu.vpt.smartambulance;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;

import java.util.HashMap;

/**
 * Created by acer on 10/30/2016.
 */
public class SessionManager {
    // Shared Preferences
    SharedPreferences pref;

    // Editor for Shared preferences
    SharedPreferences.Editor editor;

    // Context
    Context _context;

    // Shared pref mode
    int PRIVATE_MODE = 0;

    // Sharedpref file name
    private static final String PREF_NAME = "Driver";

    // All Shared Preferences Keys
    private static final String IS_LOGIN = "IsLoggedIn";

    // User name (make variable public to access from outside)
    public static final String KEY_NAME = "name";

    // ID (make variable public to access from outside)
    public static final String KEY_ID = "a_id";

    public static final String KEY_HOSPITAL = "hospital";

    public static final String KEY_VEHICLE = "vehicle";
    public static final String KEY_MOBILE = "mobile";
    public static final String KEY_CAR = "car";
    public static final String KEY_AADHAR = "aadhar";
    public static final String KEY_MAIL_ID = "doc_mail_id";




    // Constructor
    public SessionManager(Context context){
        this._context = context;
        pref = _context.getSharedPreferences(PREF_NAME, PRIVATE_MODE);
        editor = pref.edit();
    }

    public String getID(){
        return pref.getString(KEY_ID,null);
    }
	
	public String getNAME(){
        return pref.getString(KEY_NAME,null);
    }

    public  String getHOSPITAL(){return pref.getString(KEY_HOSPITAL,null);}

    public  String getVEHICLE(){return pref.getString(KEY_VEHICLE,null);}

    public  String getMOBILE(){return pref.getString(KEY_MOBILE,null);}


    public  String getCAR(){return pref.getString(KEY_CAR,null);}

    public  String getAADHAR(){return pref.getString(KEY_AADHAR,null);}

    public  String getMAIL_ID(){return pref.getString(KEY_MAIL_ID,null);}

    /**
     * Create login session
     * */

    public void createDoctorLoginSession(String driver_id, String driver_name,String driver_hospital,String driver_mobile,String doc_mail_id){
        // Storing login value as TRUE
        editor.putBoolean(IS_LOGIN, true);

        // Storing id in pref
        editor.putString(KEY_ID, driver_id);

        // Storing name in pref
        editor.putString(KEY_NAME, driver_name);
        editor.putString(KEY_HOSPITAL, driver_hospital);
        editor.putString(KEY_MAIL_ID,doc_mail_id);
        editor.putString(KEY_MOBILE,driver_mobile);





        // commit changes
        editor.commit();

    }




    public void createLoginSession(String driver_id, String driver_name,String driver_hospital,String driver_vehicle,String driver_mobile,String driver_car,String driver_aadhar){
        // Storing login value as TRUE
        editor.putBoolean(IS_LOGIN, true);

		// Storing id in pref
        editor.putString(KEY_ID, driver_id);

        // Storing name in pref
        editor.putString(KEY_NAME, driver_name);
        editor.putString(KEY_HOSPITAL, driver_hospital);
        editor.putString(KEY_VEHICLE, driver_vehicle);

        editor.putString(KEY_MOBILE, driver_mobile);

        editor.putString(KEY_CAR, driver_car);
        editor.putString(KEY_AADHAR, driver_aadhar);






        // commit changes
        editor.commit();

    }

    /**
     * Check login method wil check user login status
     * If false it will redirect user to login page
     * Else won't do anything
     * */
    public void checkLogin() {
        // Check login status0.
        if (this.isLoggedIn()) {
            // user is not logged in redirect him to Login Activity
            Intent i = new Intent(_context, LoginActivity.class);
            // Closing all the Activities
            i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);

            // Add new Flag to start new Activity
            i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);

            // Staring Login Activity
            _context.startActivity(i);
        }
    }
    public void checkLogin1(){
        // Check login status
        if(this.isLoggedIn()){
            // user is not logged in redirect him to Login Activity
            Intent i = new Intent(_context, LoginActivity.class);
            // Closing all the Activities
            i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);

            // Add new Flag to start new Activity
            //i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            i.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
            //Intent.FLAG_ACTIVITY_CLEAR_TASK|Intent.FLAG_ACTIVITY_NEW_TASK
            // Staring Login Activity
            _context.startActivity(i);
        }
    }



    /**
     * Get stored session data
     * */
    public HashMap<String, String> getUserDetails(){
        HashMap<String, String> user = new HashMap<String, String>();

		// user email id
        user.put(KEY_ID, pref.getString(KEY_ID, null));

        // user name
        user.put(KEY_NAME, pref.getString(KEY_NAME, null));

        user.put(KEY_HOSPITAL, pref.getString(KEY_HOSPITAL, null));
        user.put(KEY_VEHICLE, pref.getString(KEY_VEHICLE, null));
        user.put(KEY_MOBILE, pref.getString(KEY_MOBILE, null));
        user.put(KEY_CAR, pref.getString(KEY_CAR, null));
        user.put(KEY_AADHAR, pref.getString(KEY_AADHAR, null));


        // return user
        return user;
    }

    /**
     * Clear session details
     * */
    public void logoutUser(){
        // Clearing all data from Shared Preferences
        editor.clear();
        editor.commit();

        // After logout redirect user to Loing Activity

        Intent i = new Intent(_context, LoginActivity.class);
        // Closing all the Activities
        i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);

        // Add new Flag to start new Activity
        i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);

        // Staring Login Activity
        _context.startActivity(i);
    }

    /**
     * Quick check for login
     * **/
    // Get Login State
    public boolean isLoggedIn(){
        return pref.getBoolean(IS_LOGIN, false);
    }
}

