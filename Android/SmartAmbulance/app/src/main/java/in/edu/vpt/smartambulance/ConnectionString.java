package in.edu.vpt.smartambulance;

import android.app.Application;

/**
 * Created by acer on 6/19/2018.
 + */
public class ConnectionString extends Application {
   // public String server_loc = "http://172.16.19.31/SmartAmbulance/";
    //  public String server_loc = "http://192.168.43.1/SmartAmbulance/";
   // public String server_loc = "https://smartambulance.ga/";
    //public String server_loc = "http://182.18.155.38:8080/";
   public String server_loc = "http://smartambulance.16mb.com/";

    public String getCS() {
        return server_loc;
    }
}

