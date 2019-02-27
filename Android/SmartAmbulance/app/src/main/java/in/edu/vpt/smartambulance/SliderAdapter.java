package in.edu.vpt.smartambulance;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.res.Resources;
import android.preference.PreferenceManager;
import android.support.annotation.NonNull;
import android.support.v4.view.PagerAdapter;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import java.util.ArrayList;

public class SliderAdapter extends PagerAdapter {
    Context context;
    Activity a;
    LayoutInflater layoutInflater;
    ArrayList<String> slide_headings = new ArrayList<>();
    ArrayList<String> slide_desc = new ArrayList<>();

    private static final String TAG = "SliderAdapter";

    public SliderAdapter(Context context, ArrayList<String> slide_headings, ArrayList<String> slide_desc) {
        this.context = context;
        this.slide_headings = slide_headings;
        this.slide_desc = slide_desc;
    }

    //Arrays
    public int[] slide_images = {

            R.drawable.mapf,
            R.drawable.notif,
            R.drawable.googlemaps
    };

    @Override
    public int getCount() {
        return slide_headings.size();
    }

    @Override
    public boolean isViewFromObject(@NonNull View view, @NonNull Object o) {
        return view == (RelativeLayout) o;
    }

    @NonNull
    @Override
    public Object instantiateItem(@NonNull ViewGroup container, int position) {

        layoutInflater = (LayoutInflater) context.getSystemService(context.LAYOUT_INFLATER_SERVICE);
        View view = layoutInflater.inflate(R.layout.slide_layout, container, false);

        ImageView slideImageView = view.findViewById(R.id.slide_images);
        TextView slideHeading = view.findViewById(R.id.slide_heading);
        TextView slideDescription = view.findViewById(R.id.slide_desc);


        slideImageView.setImageResource(slide_images[position]);
        slideHeading.setText(slide_headings.get(position));
        slideDescription.setText(slide_desc.get(position));

        container.addView(view);

        return view;


    }

    @Override
    public void destroyItem(@NonNull ViewGroup container, int position, @NonNull Object object) {

        container.removeView((RelativeLayout) object);

    }
}
