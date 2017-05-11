package nhom33.travelassistant;

import android.content.Context;
import android.content.Intent;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;
import android.database.SQLException;
import java.util.ArrayList;

import nhom33.travelassistant.DbHelper;

public class MainActivity extends BaseActivity {
    DbHelper myDbHelper;
    Spinner sprTinhThanh;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //initialDb();
        //SpinnerTinhThanh.connectDatabase(myDbHelper,context);
        //initialSpinner();
    }

    @Override
    protected void onResume() {
        setSpinnerPosition();
        super.onResume();
    }

    //=====================================================================
    public void initialDb() {
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

    //=====================================================================
    public void initialSpinner() {

        //sprTinhThanh = (Spinner) findViewById(R.id.sprTinhThanh);
        ArrayList<String> myArray = myDbHelper.getTinhThanh();

        final ArrayAdapter<String> adapter = new ArrayAdapter<String>(this, android.R.layout.simple_spinner_dropdown_item, myArray);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        sprTinhThanh.setSelection(63);
        sprTinhThanh.setAdapter(adapter);
        adapter.notifyDataSetChanged();

        sprTinhThanh.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                Toast.makeText(MainActivity.this, String.valueOf(i), Toast.LENGTH_SHORT).show();
                // For Open New Activity
                String nameItem = (String)sprTinhThanh.getSelectedItem();
                if(!nameItem.equals("An Giang")) {
                    Intent mInNewAccount = new Intent(MainActivity.this, ChooseLocation.class);
                    startActivity(mInNewAccount);
                }
                //finish();

                // For Open New Screen
                //setContentView(R.layout.choose_location);
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });
        myDbHelper.close();
    }
    //===============================Change screen when choose item spinner=====================================

}//main
