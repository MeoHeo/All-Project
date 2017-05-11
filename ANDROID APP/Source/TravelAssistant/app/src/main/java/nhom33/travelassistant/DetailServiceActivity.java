package nhom33.travelassistant;


import android.database.Cursor;
import android.os.Bundle;
import android.support.v4.app.FragmentActivity;
import android.support.v7.widget.Toolbar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.widget.TextView;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

public class DetailServiceActivity extends BaseActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private Toolbar toolbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_service);

//        toolbar = (Toolbar)findViewById(R.id.toolbar_detail_booking);
//
//        setSupportActionBar(toolbar);
//        getSupportActionBar().setTitle("Tour");
//        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        String placeType = getIntent().getExtras().getString(ChooseLocation.ARG_PLACE_TYPE);
        //configureToolbar(placeType);

        int placeId = getIntent().getExtras().getInt(ChooseItemLocation.ARG_PLACES_ID);;
        Cursor c;
        String myName;
        String myPosition;
        String myDecription;

        if (placeType.equals(getResources().getString(R.string.nha_hang_text))){

            c = myDbHelper.getItemInfo(placeId,Contract.NhaHang.TABLE_NAME);

            myName = c.getString(c.getColumnIndexOrThrow(Contract.NhaHang.COLUMN_NAME_TEN));
            myPosition = c.getString(c.getColumnIndexOrThrow(Contract.NhaHang.COLUMN_NAME_DIACHI));
            myDecription = c.getString(c.getColumnIndexOrThrow(Contract.NhaHang.COLUMN_NAME_GHICHU));
        }
        else if (placeType.equals(getResources().getString(R.string.khach_san_text))){
            c = myDbHelper.getItemInfo(placeId,Contract.KhachSan.TABLE_NAME);

            myName = c.getString(c.getColumnIndexOrThrow(Contract.KhachSan.COLUMN_NAME_TEN));
            myPosition = c.getString(c.getColumnIndexOrThrow(Contract.KhachSan.COLUMN_NAME_DIACHI));
            myDecription = c.getString(c.getColumnIndexOrThrow(Contract.KhachSan.COLUMN_NAME_GHICHU));
        }
        else {
            c = myDbHelper.getItemInfo(placeId,Contract.DiaDanh.TABLE_NAME);

            myName = c.getString(c.getColumnIndexOrThrow(Contract.DiaDanh.COLUMN_NAME_TEN));
            myPosition = c.getString(c.getColumnIndexOrThrow(Contract.DiaDanh.COLUMN_NAME_DIACHI));
            myDecription = c.getString(c.getColumnIndexOrThrow(Contract.DiaDanh.COLUMN_NAME_GHICHU));
        }

        configureToolbar(myName);
        TextView textPosition = (TextView) findViewById(R.id.sposition);
        textPosition.setText(String.valueOf(myPosition));
        TextView textDescription = (TextView) findViewById(R.id.decription);
        textDescription.setText(String.valueOf(myDecription));

        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);


    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                super.onBackPressed();
                break;
        }
        return super.onOptionsItemSelected(item);
    }

    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        // Add a marker in Sydney and move the camera
        LatLng sydney = new LatLng(-34, 151);
        mMap.addMarker(new MarkerOptions().position(sydney).title("Marker in Sydney"));
        mMap.moveCamera(CameraUpdateFactory.newLatLng(sydney));
    }
}
