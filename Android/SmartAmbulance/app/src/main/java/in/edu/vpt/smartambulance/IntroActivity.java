package in.edu.vpt.smartambulance;


import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.text.Html;
import android.view.View;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.TextView;

import java.util.ArrayList;

public class IntroActivity extends AppCompatActivity {
    public Button btn;


    private ViewPager mSlideViewPager;
    private LinearLayout mDotLayout;

    private TextView[] mDots;

    private SliderAdapter slideAdapter;
    ArrayList<String> slide_headings = new ArrayList<>();
    ArrayList<String> slide_desc = new ArrayList<>();

    private Button mNextBtn;
    private Button mBackBtn;
    private int mCurrentPage;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_intro);


        mSlideViewPager = (ViewPager) findViewById(R.id.viewpager);

        mDotLayout = (LinearLayout) findViewById(R.id.dots);

        mNextBtn = (Button) findViewById(R.id.nextBtn);
        mBackBtn = (Button) findViewById(R.id.prevBtn);

        setupArrayLists();

        slideAdapter = new SliderAdapter(this, slide_headings, slide_desc);

        mSlideViewPager.setAdapter(slideAdapter);

        addDotsIndicator(0);

        mSlideViewPager.addOnPageChangeListener(viewListener);

        mNextBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mSlideViewPager.setCurrentItem(mCurrentPage +1);
            }
        });

        mBackBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                mSlideViewPager.setCurrentItem(mCurrentPage -1);
            }
        });

    }

    private void setupArrayLists() {
        slide_headings.add(getString(R.string.monitor));
        slide_headings.add(getString(R.string.notifi));
        slide_headings.add(getString(R.string.google));

        slide_desc.add(getString(R.string.monitordes));
        slide_desc.add(getString(R.string.notifides));
        slide_desc.add(getString(R.string.googledes));
    }

    public void addDotsIndicator(int position){

        mDots = new TextView[3];
        mDotLayout.removeAllViews();

        for(int i=0 ; i<mDots.length; i++)
        {
            mDots[i] = new TextView(this);
            mDots[i].setText(Html.fromHtml("&#8226"));
            mDots[i].setTextSize(35);

            mDotLayout.addView(mDots[i]);
        }

        if(mDots.length>0){
            mDots[position].setTextColor(getResources().getColor(R.color.windowBackground));
        }



    }

    ViewPager.OnPageChangeListener viewListener = new ViewPager.OnPageChangeListener() {
        @Override
        public void onPageScrolled(int i, float v, int i1) {

        }

        @Override
        public void onPageSelected(int i) {

            addDotsIndicator(i);
            mCurrentPage = i;

            if(i == 0){
                mNextBtn.setEnabled(true);
                mBackBtn.setEnabled(false);
                mBackBtn.setVisibility(View.INVISIBLE);


                mNextBtn.setText("Next");
                mBackBtn.setText("");
            } else if (i == mDots.length -1) {
                mNextBtn.setEnabled(true);
                mBackBtn.setEnabled(true);
                mBackBtn.setVisibility(View.VISIBLE);


                mNextBtn.setText("Finish");
                mNextBtn.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        SharedPreferences.Editor editor= IntroActivity.this.getSharedPreferences("Settings",MODE_PRIVATE).edit();
                        editor.putBoolean("My_Slider",true);
                        editor.apply();

                        startActivity(new Intent(IntroActivity.this,LoginActivity.class));
                        finish();
                    }
                });
                mBackBtn.setText("Back");
            } else {
                mNextBtn.setEnabled(true);
                mBackBtn.setEnabled(true);
                mBackBtn.setVisibility(View.VISIBLE);

                mNextBtn.setText("Next");
                mBackBtn.setText("Back");
            }

        }


        @Override
        public void onPageScrollStateChanged(int i) {

        }
    };



}
