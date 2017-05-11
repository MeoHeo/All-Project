package nhom33.travelassistant;

import android.content.Intent;
import android.database.SQLException;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MotionEvent;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;

import java.io.IOException;
import java.util.ArrayList;

/**
 * Created by Aki on 28/11/2016.
 */

public abstract class BaseActivity extends AppCompatActivity {
    public static final String ARG_SPINNER_POSITION = "nhom33.travelassistant.spinnerSelectedPos";
    Toolbar myToolbar;
    CustomSpinner mySpinner;
    DbHelper myDbHelper;
    private boolean spinnerTouched; // prevent spinner firing off by listen to user touch event

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        initialDb();
        spinnerTouched = false;
    }

    @Override
    public void setContentView(int layoutResID) {
        View view = getLayoutInflater().inflate(layoutResID, null);
        super.setContentView(view);

        myToolbar = (Toolbar) findViewById(R.id.my_toolbar);
        if (myToolbar != null) {
            setSupportActionBar(myToolbar);
            mySpinner = (CustomSpinner) findViewById(R.id.my_spinner);

            switch (layoutResID) {
                case R.layout.activity_main:
                case R.layout.activity_choose_location:
                case R.layout.activity_choose_item_location: {
                    getSupportActionBar().setDisplayShowTitleEnabled(false);
                    setUpSpinner();
                    break;
                }
                case R.layout.activity_detail_service:
                case R.layout.activity_detail_tour: {
                    mySpinner.setVisibility(View.GONE);
                    break;
                }
                default:
                    break;
            }
        }
    }

    private void setUpSpinner() {
        if (mySpinner != null) {
            ArrayList<String> myArray = myDbHelper.getTinhThanh();
            ArrayAdapter<String> adapter = new HintAdapter(this, android.R.layout.simple_spinner_dropdown_item, myArray);
            adapter.add(getResources().getString(R.string.spinnerPrompt));
            mySpinner.setAdapter(adapter);

            mySpinner.setOnTouchListener(new View.OnTouchListener() {
                @Override
                public boolean onTouch(View view, MotionEvent motionEvent) {
                    spinnerTouched = true;
                    return false;
                }
            });
            mySpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                @Override
                public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                    if (spinnerTouched) {
                        Intent intent = new Intent(BaseActivity.this, ChooseLocation.class);
                        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                        intent.putExtra(ARG_SPINNER_POSITION, i);
                        startActivity(intent);
                        spinnerTouched = false;
                    }
                }

                @Override
                public void onNothingSelected(AdapterView<?> adapterView) {

                }
            });
        }
    }

    protected String getSpinnerItemName(){
        if (mySpinner.getVisibility() != View.GONE){
            return mySpinner.getSelectedItem().toString();
        }
        return null;
    }

    protected void setSpinnerPosition() {
        // default MainActivity spinner position (hint text position)
        if (mySpinner.getVisibility() != View.GONE) {
            mySpinner.setSelection(mySpinner.getAdapter().getCount() - 1);
        }
    }

    protected void setSpinnerPosition(int position) {
        if (mySpinner.getVisibility() != View.GONE) {
            mySpinner.setSelection(position);
        }
    }

    protected void configureToolbar(String title) {
        if (getSupportActionBar() != null) {
            getSupportActionBar().setDisplayShowTitleEnabled(true);
            //setSupportActionBar(toolbar);
            getSupportActionBar().setTitle(title);
            getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        }
    }

    private void initialDb() {
        myDbHelper = new DbHelper(this);
        try {
            myDbHelper.createDataBase();
        } catch (IOException ioe) {
            throw new Error("Unable to create database");
        }
        try {
            myDbHelper.openDataBase();
        } catch (SQLException sqle) {
            throw sqle;
        }
    }
}
