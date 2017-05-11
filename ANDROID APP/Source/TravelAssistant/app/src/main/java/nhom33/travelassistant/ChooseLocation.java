package nhom33.travelassistant;

import android.content.Context;
import android.content.Intent;
import android.database.SQLException;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;
import java.util.ArrayList;

public class ChooseLocation extends BaseActivity {
    public static final String ARG_PLACE_TYPE = "nhom33.travelassistant.placeType";
    int selectedPosition;
    DbHelper myDbHelper;
    Spinner sprTinhThanh;
    Context context;

    Button chooseDiaDanh; boolean isclickchooseDiaDanh;
    Button chooseKhachSan; boolean isclickchooseKhachSan;
    Button chooseNhaHang; boolean isclickchooseNhaHang;
    Button chooseTour; boolean isclickchooseTour;

    ImageButton imgBtnDiaDanh; boolean isClickImgDiaDanh;
    ImageButton imgBtnNhaHang; boolean isClickImgNhaHang;
    ImageButton imgBtnKhachSan; boolean isClickImgKhachSan;
    ImageButton imgBtnTour; boolean isClickImgTour;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_choose_location);
        context = this;

        selectedPosition = getIntent().getExtras().getInt(ARG_SPINNER_POSITION);
        setSpinnerPosition(selectedPosition);

//        String selectedItem = getSpinnerItemName();
//        Toast.makeText(this, selectedItem, Toast.LENGTH_SHORT).show();
//        String myImageName = myDbHelper.getImageName(selectedItem);
//        ImageView myImage = (ImageView) findViewById(R.id.imgTinh);
//        if (myImageName != null) {
//            int myImageResId = getResources().getIdentifier(myImageName, "drawable", getPackageName());
//            myImage.setImageResource(myImageResId);
//        }
//        else {
//            myImage.setImageResource(R.mipmap.ic_launcher);
//        }
        //initialDb();
        //initialSpinner();

        //chooseItemLocation();
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
                //Toast.makeText(MainActivity.this, String.valueOf(i), Toast.LENGTH_SHORT).show();
                // For Open New Activity
//                String nameItem = (String)sprTinhThanh.getSelectedItem();
//                if(!nameItem.equals("An Giang")) {
//                    Intent mInNewAccount = new Intent(context, ChooseLocation.class);
//                    startActivity(mInNewAccount);
//                }
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
    //===============================Choose Location=====================================
    public void chooseItemLocation() {
        chooseDiaDanh = (Button) findViewById(R.id.btnDiaDanh);             isclickchooseDiaDanh = false;
        chooseKhachSan = (Button) findViewById(R.id.btnKhachSan);           isclickchooseKhachSan=false;
        chooseNhaHang = (Button) findViewById(R.id.btnNhaHang);             isclickchooseNhaHang=false;
        chooseTour = (Button) findViewById(R.id.btnTour);                   isclickchooseTour=false;

        imgBtnDiaDanh = (ImageButton) findViewById(R.id.imgBtnDiaDanh);     isClickImgDiaDanh=false;
        imgBtnNhaHang = (ImageButton) findViewById(R.id.imgBtnNhaHang);     isClickImgNhaHang=false;
        imgBtnKhachSan = (ImageButton) findViewById(R.id.imgBtnKhachSan);   isClickImgKhachSan=false;
        imgBtnTour = (ImageButton) findViewById(R.id.imgBtnTour);           isClickImgTour=false;

        chooseDiaDanh.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                isclickchooseDiaDanh = true;
            }
        });

        chooseKhachSan.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                isclickchooseKhachSan = true;
            }
        });
        if(isclickchooseDiaDanh==true||isclickchooseKhachSan==true) {
            Intent mInNewAccount = new Intent(context, ChooseItemLocation.class);
            startActivity(mInNewAccount);
        }
    }

    public void onClick(View view){
        Intent intent = new Intent(ChooseLocation.this, ChooseItemLocation.class);
        intent.putExtra(ARG_SPINNER_POSITION, selectedPosition);
        switch (view.getId()) {
            case R.id.btnDiaDanh:
            case R.id.imgBtnDiaDanh:
                intent.putExtra(ARG_PLACE_TYPE, getResources().getString(R.string.dia_danh_text));
                break;
            case R.id.btnNhaHang:
            case R.id.imgBtnNhaHang:
                intent.putExtra(ARG_PLACE_TYPE, getResources().getString(R.string.nha_hang_text));
                break;
            case R.id.btnKhachSan:
            case R.id.imgBtnKhachSan:
                intent.putExtra(ARG_PLACE_TYPE, getResources().getString(R.string.khach_san_text));
                break;
            case R.id.btnTour:
            case R.id.imgBtnTour:
                intent.putExtra(ARG_PLACE_TYPE, getResources().getString(R.string.tour_text));
                break;
            default:
                break;
        }
        startActivity(intent);
    }
}//main
