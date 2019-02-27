package in.edu.vpt.smartambulance;

import android.Manifest;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.IntentSender;
import android.content.pm.PackageManager;
import android.graphics.Color;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.os.Handler;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.FragmentActivity;
import android.support.v4.content.ContextCompat;
import android.util.Log;
import android.view.KeyEvent;
import android.view.View;
import android.view.WindowManager;
import android.view.inputmethod.EditorInfo;
import android.widget.AdapterView;
import android.widget.AutoCompleteTextView;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ZoomControls;

import com.directions.route.AbstractRouting;
import com.directions.route.Route;
import com.directions.route.RouteException;
import com.directions.route.Routing;
import com.directions.route.RoutingListener;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.common.api.PendingResult;
import com.google.android.gms.common.api.ResultCallback;
import com.google.android.gms.common.api.Status;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationListener;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.location.LocationSettingsRequest;
import com.google.android.gms.location.LocationSettingsResult;
import com.google.android.gms.location.LocationSettingsStatusCodes;
import com.google.android.gms.location.places.AutocompleteFilter;
import com.google.android.gms.location.places.AutocompletePrediction;
import com.google.android.gms.location.places.Place;
import com.google.android.gms.location.places.PlaceBuffer;
import com.google.android.gms.location.places.Places;

import com.google.android.gms.maps.CameraUpdate;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.LatLngBounds;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polyline;
import com.google.android.gms.maps.model.PolylineOptions;
import com.google.android.gms.tasks.OnSuccessListener;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.concurrent.TimeUnit;

import static android.os.Build.VERSION_CODES.M;

public class MapsActivity extends FragmentActivity implements RoutingListener, OnMapReadyCallback, GoogleApiClient.ConnectionCallbacks, GoogleApiClient.OnConnectionFailedListener, LocationListener {

    public  GoogleMap mMap;
    private final static int MY_PERMISSION_FINE_LOCATION = 101;

    public Location location;

    int counter=0;
    ZoomControls zoom;
    Button markBt;
    Button geoLocationBt;
    Button satView;
    Button clear;
    private  Button silderbutton;
    Double myLatitude = null;
    Double myLongitude = null;
    private GoogleApiClient googleApiClient;
    private LocationRequest locationRequest;
    private static CountDownTimer countDownTimer;
    ConnectionString cs=new ConnectionString();
//    private static final String MAP_INFO_URL = "http://vpwork.16mb.com/ambulance/update_map_info.php";
    private  final String MAP_INFO_URL = cs.getCS()+"Mobile_Code/send_ambulance_data.php";
    private final String DEST_INFO_URL=cs.getCS()+"Mobile_Code/send_destination.php";
    private  final String ALERT_INFO_URL = cs.getCS()+"Mobile_Code/send_alert_data.php";
    protected static final String TAG = "MapsActvity";
    final Handler handler = new Handler();
    final Handler handler2 = new Handler();
    protected static final int REQUEST_CHECK_SETTINGS = 0x1;
    private static final float DEFAULT_ZOOM = 15f;
    private static final LatLngBounds LAT_LNG_BOUNDS = new LatLngBounds(
            new LatLng( 19.0728300,72.8826100), new LatLng(19.0728300, 72.8826100));
    private PlaceAutocompleteAdapter mPlaceAutocompleteAdapter;
    private AutoCompleteTextView mSearchText;
    Double getEndLatitude=null;
    Double getEndLongitude=null;
    float results[]=new float[10];
    Location location1;
    boolean alreadyExecuted=false;
    LatLng destination=null;
    LatLng pickup=null;
    ImageButton imageButton;
    boolean checkRoute =false;

TextView routeone;
    TextView routetwo;
    TextView routethree;
    SessionManager sessionManager;
    private List<Polyline> polylines;
    private static final int[] COLORS = new int[]{R.color.Blue,R.color.Red,R.color.Green,R.color.Orange,R.color.Yellow};



    AutocompleteFilter typeFilter = new AutocompleteFilter.Builder()
            .setTypeFilter(Place.TYPE_COUNTRY).setCountry("IND")
            .build();






    private PlaceInfo mPlace;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_maps);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);
        polylines = new ArrayList<>();
            sessionManager=new SessionManager(getApplicationContext());
        silderbutton=findViewById(R.id.slideButton);

        routeone=findViewById(R.id.text4);
        routetwo=findViewById(R.id.text5);
        routethree=findViewById(R.id.text);
        googleApiClient = new GoogleApiClient.Builder(this)
                .addApi(LocationServices.API)
                .addApi(Places.GEO_DATA_API)
                .addApi(Places.PLACE_DETECTION_API)
                .addConnectionCallbacks(this)

                .addOnConnectionFailedListener(this)
                .build();

        locationRequest = new LocationRequest();
        locationRequest.setInterval(15 * 1000);
        locationRequest.setFastestInterval(5 * 1000);
        locationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);

        mPlaceAutocompleteAdapter = new PlaceAutocompleteAdapter(this, googleApiClient,
                LAT_LNG_BOUNDS, typeFilter);


        LocationSettingsRequest.Builder builder = new LocationSettingsRequest.Builder().addLocationRequest(locationRequest);
        builder.setAlwaysShow(true);

        PendingResult<LocationSettingsResult> result = LocationServices.SettingsApi.checkLocationSettings(googleApiClient, builder.build());
        result.setResultCallback(new ResultCallback<LocationSettingsResult>() {


            @Override
            public void onResult(LocationSettingsResult result) {
                final Status status = result.getStatus();
                switch (status.getStatusCode()) {
                    case LocationSettingsStatusCodes.SUCCESS:
                        Log.i(TAG, "All location settings are satisfied.");

                        break;
                    case LocationSettingsStatusCodes.RESOLUTION_REQUIRED:
                        Log.i(TAG, "Location settings are not satisfied. Show the user a dialog to upgrade location settings ");

                        try {
                            // Show the dialog by calling startResolutionForResult(), and check the result
                            // in onActivityResult().
                            status.startResolutionForResult(MapsActivity.this, REQUEST_CHECK_SETTINGS);
                        } catch (IntentSender.SendIntentException e) {
                            Log.i(TAG, "PendingIntent unable to execute request.");
                        }
                        break;
                    case LocationSettingsStatusCodes.SETTINGS_CHANGE_UNAVAILABLE:
                        Log.i(TAG, "Location settings are inadequate, and cannot be fixed here. Dialog not created.");
                        break;
                }
            }
        });
        //set to balanced power accuracy on real device

        zoom = (ZoomControls) findViewById(R.id.zcZoom);
        zoom.setOnZoomOutClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mMap.animateCamera(CameraUpdateFactory.zoomOut());

            }
        });
        zoom.setOnZoomInClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mMap.animateCamera(CameraUpdateFactory.zoomIn());

            }
        });


        mSearchText=(AutoCompleteTextView)findViewById(R.id.etLocationEntry);
        mSearchText.setAdapter(mPlaceAutocompleteAdapter);

        mSearchText.setOnItemClickListener(
                new AdapterView.OnItemClickListener() {
                    @Override
                    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {

                        Log.d(TAG, "geoLocate: geolocating");
                String searchString = mSearchText.getText().toString();

                Geocoder geocoder = new Geocoder(MapsActivity.this);
                List<Address> list = new ArrayList<>();
                try {
                    list = geocoder.getFromLocationName(searchString, 1);
                } catch (IOException e) {
                    Log.e(TAG, "geoLocate: IOException: " + e.getMessage());
                }

                if (list.size() > 0) {
                    Address address = list.get(0);

                    Log.d(TAG, "geoLocate: found a location: " + address.toString());
                    //Toast.makeText(this, address.t    oString(), Toast.LENGTH_SHORT).show();

                    moveCamera(new LatLng(address.getLatitude(), address.getLongitude()), DEFAULT_ZOOM,
                            address.getAddressLine(0));

                    getEndLatitude = address.getLatitude();
                    getEndLongitude = address.getLongitude();
                    LatLng destination = new LatLng(getEndLatitude, getEndLongitude);


                    getroute(destination);


                }





            }



        });

        mSearchText.setOnEditorActionListener(new TextView.OnEditorActionListener() {
@Override
public boolean onEditorAction(TextView textView, int actionId, KeyEvent keyEvent) {
        if(actionId == EditorInfo.IME_ACTION_SEARCH ||
        actionId == EditorInfo.IME_ACTION_SEND
        || actionId == EditorInfo.IME_ACTION_DONE
        || keyEvent.getAction() == KeyEvent.ACTION_DOWN
        )
        {

        mMap.clear();



            Log.d(TAG, "geoLocate: geolocating");

            String searchString = mSearchText.getText().toString();

            Geocoder geocoder = new Geocoder(MapsActivity.this);
            List<Address> list = new ArrayList<>();
            try {
                list = geocoder.getFromLocationName(searchString, 1);
            } catch (IOException e) {
                Log.e(TAG, "geoLocate: IOException: " + e.getMessage());
            }

            if (list.size() > 0) {
                Address address = list.get(0);

                Log.d(TAG, "geoLocate: found a location: " + address.toString());
                //Toast.makeText(this, address.toString(), Toast.LENGTH_SHORT).show();

                moveCamera(new LatLng(address.getLatitude(), address.getLongitude()), DEFAULT_ZOOM,
                        address.getAddressLine(0));

                getEndLatitude = address.getLatitude();
                getEndLongitude = address.getLongitude();
                LatLng destination = new LatLng(getEndLatitude, getEndLongitude);
               getroute(destination);
               String getEndlatString=getEndLatitude.toString();
               String getEndlangString=getEndLongitude.toString();
               String name=sessionManager.getNAME();
                senddestination(getEndlatString,getEndlangString,name);



            }
        }




            return false;
        }
    });




        imageButton=findViewById(R.id.cancel_action);
        imageButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                int len=mSearchText.getText().length();
                if(len!=0)
                    mSearchText.setText(" ");

            }
        });



        satView =  findViewById(R.id.btSatellite);
        satView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (mMap.getMapType() == GoogleMap.MAP_TYPE_NORMAL) {
                    mMap.setMapType(GoogleMap.MAP_TYPE_SATELLITE);
                    satView.setText("Normal");

                } else {
                    mMap.setMapType(GoogleMap.MAP_TYPE_NORMAL);
                    satView.setText("Satellite");
                }

            }
        });

        clear = findViewById(R.id.btClear);
        clear.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mMap.clear();
            }
        });

        AdapterView.OnItemClickListener mAutocompleteClickListener = new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                hideSoftKeyboard();


                final AutocompletePrediction item = mPlaceAutocompleteAdapter.getItem(i);
                final String placeId = item.getPlaceId();

                PendingResult<PlaceBuffer> placeResult = Places.GeoDataApi
                        .getPlaceById(googleApiClient, placeId);
                placeResult.setResultCallback(mUpdatePlaceDetailsCallback);
            }
        };


    }

             //alexander library used over here finds route to destination //
   private void getroute(LatLng destination) {

        Routing routing = new Routing.Builder()
                .travelMode(AbstractRouting.TravelMode.DRIVING)
                .withListener(this)
                .alternativeRoutes(true)
           //AIzaSyBoihc14koA7HFnp-KAXq5GFfFQNEDkluY
                .waypoints(new LatLng(myLatitude,myLongitude),destination)
                .key("AIzaSyALJt9-4XGN2XaGMtsjJEy2N8EEEf0FPgY")
                .build();
              routing.execute();
    }


    private void moveCamera(LatLng latLng, float zoom, String title){
        Log.d(TAG, "moveCamera: moving the camera to: lat: " + latLng.latitude + ", lng: " + latLng.longitude );
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng, zoom));

        if(!title.equals("My Location")){
            MarkerOptions options = new MarkerOptions()
                    .position(latLng)
                    .title(title);
            mMap.addMarker(options);
        }

        hideSoftKeyboard();
    }
    private void hideSoftKeyboard(){
        this.getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_ALWAYS_HIDDEN);




    }










    private ResultCallback<PlaceBuffer> mUpdatePlaceDetailsCallback = new ResultCallback<PlaceBuffer>() {
        @Override
        public void onResult(@NonNull PlaceBuffer places) {
            if(!places.getStatus().isSuccess()){
                Log.d(TAG, "onResult: Place query did not complete successfully: " + places.getStatus().toString());
                places.release();
                return;
            }
            final Place place = places.get(0);

            try{
                mPlace = new PlaceInfo();
                mPlace.setName(place.getName().toString());
                Log.d(TAG, "onResult: name: " + place.getName());
                mPlace.setAddress(place.getAddress().toString());
                Log.d(TAG, "onResult: address: " + place.getAddress());
//                mPlace.setAttributions(place.getAttributions().toString());
//                Log.d(TAG, "onResult: attributions: " + place.getAttributions());
                mPlace.setId(place.getId());
                Log.d(TAG, "onResult: id:" + place.getId());
                mPlace.setLatlng(place.getLatLng());
                Log.d(TAG, "onResult: latlng: " + place.getLatLng());
                mPlace.setRating(place.getRating());
                Log.d(TAG, "onResult: rating: " + place.getRating());
                mPlace.setPhoneNumber(place.getPhoneNumber().toString());
                Log.d(TAG, "onResult: phone number: " + place.getPhoneNumber());
                mPlace.setWebsiteUri(place.getWebsiteUri());
                Log.d(TAG, "onResult: website uri: " + place.getWebsiteUri());

                Log.d(TAG, "onResult: place: " + mPlace.toString());
            }catch (NullPointerException e){
                Log.e(TAG, "onResult: NullPointerException: " + e.getMessage() );
            }

            moveCamera(new LatLng(place.getViewport().getCenter().latitude,
                    place.getViewport().getCenter().longitude), DEFAULT_ZOOM, mPlace.getName());

            places.release();
        }
    };



                    //To send the details over top the server//



    private void sendmapinfo(String aid, String name,String vehicle,String hospitalname,String Latitude, String Longitude) {


        class RegisterUser1 extends AsyncTask<String, Void, String> {
            DataReader ruc = new DataReader();
           ProgressDialog loading;


            @Override
             protected void onPreExecute() {
                 super.onPreExecute();
                 loading = ProgressDialog.show(MapsActivity.this, "Please Wait",null, true, true);

             }

             @Override
             protected void onPostExecute(String s) {
                 super.onPostExecute(s);
                 loading.dismiss();
                 Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
                 if(s.equalsIgnoreCase("success")){
                      Toast.makeText(getApplicationContext(), "Map Information Updated on Server", Toast.LENGTH_LONG).show();
                 }else {
                     Toast.makeText(getApplicationContext(), "Request Not Send. Try Again!", Toast.LENGTH_LONG).show();
                 }
             }

            @Override
            protected String doInBackground(String... params) {
                HashMap<String, String> data = new HashMap<String,String>();
                data.put("id",params[0]);
                data.put("name",params[1]);

                data.put("vehicle",params[2]);

                data.put("hospitalname",params[3]);

                data.put("latitude",params[4]);
                data.put("longitude",params[5]);

                String result = ruc.sendPostRequest(MAP_INFO_URL,data);

                return  result;

            }
        }

        RegisterUser1 ru = new RegisterUser1();
        ru.execute(aid,name,vehicle,hospitalname,Latitude,Longitude);
    }





    private void senddestination(String lat, String lang,String name) {


        class RegisterUser1 extends AsyncTask<String, Void, String> {
            DataReader ruc = new DataReader();
            ProgressDialog loading;


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(MapsActivity.this, "Please Wait",null, true, true);

            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
                if(s.equalsIgnoreCase("success")){
                    Toast.makeText(getApplicationContext(), "Destination Information Updated on Server", Toast.LENGTH_LONG).show();
                }else {
                    Toast.makeText(getApplicationContext(), "Request Not Send. Try Again!", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            protected String doInBackground(String... params) {
                HashMap<String, String> data = new HashMap<String,String>();
                data.put("lat",params[0]);
                data.put("lang",params[1]);
                data.put("name",params[2]);


                String result = ruc.sendPostRequest(DEST_INFO_URL,data);

                return  result;

            }
        }

        RegisterUser1 ru = new RegisterUser1();
        ru.execute(lat,lang,name);
    }






    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on  the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;


    /*    mMap.setOnMapClickListener(new GoogleMap.OnMapClickListener() {
            @Override
            public void onMapClick(LatLng latLng) {
                mMap.clear();
                mMap.addMarker(new MarkerOptions().position(latLng).title("from onMapClick"));
                mMap.animateCamera(CameraUpdateFactory.newLatLng(latLng));



            }
        });*/




        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED) {

            mMap.setMyLocationEnabled(true);



          /*  if(REQUEST_CHECK_SETTINGS!=0x1)
            {


                Intent intent=new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS  );
                startActivity(intent);
            }*/


        } else {

            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                requestPermissions(new String[]{Manifest.permission.ACCESS_FINE_LOCATION}, MY_PERMISSION_FINE_LOCATION);
            }
        }


        }
















        @Override
    public void onRequestPermissionsResult ( int requestCode, @NonNull String[] permissions,
                                             @NonNull int[] grantResults){
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        switch (requestCode) {

            case MY_PERMISSION_FINE_LOCATION:
                if (grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                    if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
                        mMap.setMyLocationEnabled(true);


                    //    LocationSettingsreRequest.Builder builder = new LocationSettingsRequest.Builder();

                        handler.postDelayed(new Runnable() {

                            @Override
                            public void run() {
                                // this code will be executed after 2 seconds
                               Toast.makeText(getApplicationContext(), "This Reaching progress", Toast.LENGTH_LONG).show();

                                String aid = sessionManager.getID();
                                String name=sessionManager.getNAME();
                                String vehicle=sessionManager.getVEHICLE();
                                String hospital=sessionManager.getHOSPITAL();

                                String emlat = Double.toString(myLatitude);
                                String emlog = Double.toString(myLongitude);
                                sendmapinfo(aid,name,vehicle,hospital,emlat,emlog);


                                handler.postDelayed(this, 5000);
                            }
                        },5000);

                    }

                } else {
                    Toast.makeText(getApplicationContext(), "This app requires location permissions to be granted", Toast.LENGTH_LONG).show();
                    finishAffinity();

                }
                break;
        }
    }




    @Override
    public void onConnected(@Nullable Bundle bundle) {
        requestLocationUpdates();
    }

    private void requestLocationUpdates() {
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
            LocationServices.FusedLocationApi.requestLocationUpdates(googleApiClient, locationRequest, this);

        }


    }

    @Override
    public void onConnectionSuspended(int i) {
        Log.i(TAG, "Connection Suspended");
    }

    @Override
    public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {
        Log.i(TAG, "Connection Failed: ConnectionResult.getErrorCode() = " + connectionResult.getErrorCode());
    }

    @Override
    public void onLocationChanged(Location location) {
        myLatitude = location.getLatitude();
        myLongitude = location.getLongitude();
        location1=location;
        if(checkRoute) {
            handler.postDelayed(new Runnable() {

                @Override
                public void run() {
                    // this code will be executed after 2 seconds

                    if (location1.getLatitude() == myLatitude && location1.getLatitude() == myLongitude) {
                        startTimer(5);

                        if (location1.getLatitude() != myLatitude && location1.getLatitude() != myLongitude) {
                            stopCountdown();
                        } else if (counter > 0) {

                            String alertmobile=sessionManager.getNAME();
                            sendalert(alertmobile);
                        }


                    }


                    handler.postDelayed(this, 5000);
                }
            }, 5000);
        }
        if(!alreadyExecuted) {
          LatLng pickup=new LatLng(myLatitude,myLongitude);
            mMap.moveCamera(CameraUpdateFactory.newLatLng(pickup));
            mMap.animateCamera(CameraUpdateFactory.zoomTo(20));
            alreadyExecuted=true;
      }
    }

    @Override
    protected void onStart() {
        super.onStart();
        googleApiClient.connect();

    }

    @Override
    protected void onPause() {
        super.onPause();
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) == PackageManager.PERMISSION_GRANTED)
            LocationServices.FusedLocationApi.removeLocationUpdates(googleApiClient, this);
    }


    @Override
    protected void onResume() {
        super.onResume();
        if (googleApiClient.isConnected()) {
            requestLocationUpdates();
        }
    }

    @Override
    protected void onStop() {
        super.onStop();
        handler.removeCallbacksAndMessages(null);
        googleApiClient.disconnect();
    }


    @Override
    public void onRoutingFailure(RouteException e) {


        if(e != null) {
            Toast.makeText(this, "Error: " + e.getMessage(), Toast.LENGTH_LONG).show();
        }else {
            Toast.makeText(this, "Something went wrong, Try again", Toast.LENGTH_SHORT).show();
        }

    }

    @Override
    public void onRoutingStart() {

    }

    @Override
    public void onRoutingSuccess(ArrayList<Route> route , int shortestRouteIndex) {



        if(polylines.size()>0) {
            for (Polyline poly : polylines) {
                poly.remove();
            }
        }

        polylines = new ArrayList<>();
        //add route(s) to the map.
        for (int i = 0; i <route.size(); i++) {

            //In case of more than 5 alternative routes
            int colorIndex = i % COLORS.length;

            PolylineOptions polyOptions = new PolylineOptions();
            polyOptions.color(getResources().getColor(COLORS[colorIndex]));
            polyOptions.width(10 + i * 3);
            polyOptions.addAll(route.get(i).getPoints());
            Polyline polyline = mMap.addPolyline(polyOptions);
            polylines.add(polyline);
            silderbutton.setVisibility(View.VISIBLE);

            if(i==0)
            {
                int seconds=route.get(i).getDurationValue();
                int hours = seconds / 3600;
                int minutes = (seconds%3600)/60;
                int seconds_output = (seconds% 3600)%60;
                int km=route.get(i).getDistanceValue()*1000;

                routeone.setText("one "+"Route "+ (i) +": distance - "+ km+"Kilometre"+": duration - "+hours+"Hours "+minutes+"minutes "+seconds_output+"Seconds");


            }
           if(i==1)
                routetwo.setText("two "+"Route "+ (i) +": distance - "+ route.get(i).getDistanceValue()+": duration - "+ route.get(i).getDurationValue());

            if(i==2)
                routethree.setText("three "+"Route "+ (i) +": distance - "+ route.get(i).getDistanceValue()+": duration - "+ route.get(i).getDurationValue());

            Toast.makeText(getApplicationContext(),"Route "+ (i+1) +": distance - "+ route.get(i).getDistanceValue()+": duration - "+ route.get(i).getDurationValue(),Toast.LENGTH_SHORT).show();

            checkRoute=true;


        }

    }

    @Override
    public void onRoutingCancelled() {

    }



    //Stop Countdown method
    private void stopCountdown() {
        if (countDownTimer != null) {
            countDownTimer.cancel();
            countDownTimer = null;
        }
    }


    //Start Countodwn method
    private void startTimer(int noOfMinutes) {
        countDownTimer = new CountDownTimer(noOfMinutes, 1000) {
            public void onTick(long millisUntilFinished) {
                long millis = millisUntilFinished;
                //Convert milliseconds into hour,minute and seconds
                String hms = String.format("%02d:%02d:%02d", TimeUnit.MILLISECONDS.toHours(millis), TimeUnit.MILLISECONDS.toMinutes(millis) - TimeUnit.HOURS.toMinutes(TimeUnit.MILLISECONDS.toHours(millis)), TimeUnit.MILLISECONDS.toSeconds(millis) - TimeUnit.MINUTES.toSeconds(TimeUnit.MILLISECONDS.toMinutes(millis)));
                //set text
            }

            public void onFinish() {
                String alertmobile=sessionManager.getNAME();
                sendalert(alertmobile);

                //On finish change timer text
                countDownTimer = null;//set CountDownTimer to null
                counter++;

            }
        }.start();

    }





    private void sendalert(String  username) {


        class RegisterUser1 extends AsyncTask<String, Void, String> {
            DataReader ruc = new DataReader();
            ProgressDialog loading;


            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(MapsActivity.this, "Please Wait",null, true, true);

            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                //Toast.makeText(getApplicationContext(),s,Toast.LENGTH_LONG).show();
                if(s.equalsIgnoreCase("success")){
                    Toast.makeText(getApplicationContext(), "Map Information Updated on Server", Toast.LENGTH_LONG).show();
                }else {
                    Toast.makeText(getApplicationContext(), "Request Not Send. Try Again!", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            protected String doInBackground(String... params) {
                HashMap<String, String> data = new HashMap<String,String>();
                data.put("name",params[0]);
                String result = ruc.sendPostRequest(ALERT_INFO_URL,data);

                return  result;

            }
        }

        RegisterUser1 ru = new RegisterUser1();
        ru.execute(username);
    }












}