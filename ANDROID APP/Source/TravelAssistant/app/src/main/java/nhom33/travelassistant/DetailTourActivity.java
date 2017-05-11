package nhom33.travelassistant;

import android.content.Intent;
import android.database.Cursor;
import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

public class DetailTourActivity extends BaseActivity {
    private Toolbar toolbar;
    public ImageView imgMotor, imgCar, imgAirplane, imgShip;
    public Button btnTour;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_tour);

        //toolbar = (Toolbar)findViewById(R.id.toolbar_detail_booking);

        String placeType = getIntent().getExtras().getString(ChooseLocation.ARG_PLACE_TYPE);
        //configureToolbar(placeType);

        int placeId = getIntent().getExtras().getInt(ChooseItemLocation.ARG_PLACES_ID);

        Cursor c = myDbHelper.getItemInfo(placeId,Contract.Tour.TABLE_NAME);

        String myName = c.getString(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_TEN));
        String myPosition = c.getString(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_DIADIEM_KHOIHANH));
        String myTime = c.getString(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_THOIGIAN_KHOIHANH));
        String myDuration = c.getString(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_THOIGIAN_KETTHUC));
        String myOrganizer = c.getString(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_DONVITOCHUC));
        String myPrice = c.getString(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_GIATOUR));
        String mySchedule = c.getString(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_LICHTRINH));
        final String myReserve = c.getString(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_DATTOUR));
        int myMotor = c.getInt(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_XEMAY));
        int myCar = c.getInt(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_XEHOI));
        int myAirplane = c.getInt(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_MAYBAY));
        int myShip = c.getInt(c.getColumnIndexOrThrow(Contract.Tour.COLUMN_NAME_TAUTHUY));

        configureToolbar(myName);
        TextView textPosition = (TextView) findViewById(R.id.position);
        textPosition.setText(String.valueOf(myPosition));
        TextView textTime = (TextView) findViewById(R.id.timedepart);
        textTime.setText(String.valueOf(myTime));
        TextView textDuration = (TextView) findViewById(R.id.duration);
        textDuration.setText(String.valueOf(myDuration));
//        TextView textOrganizer = (TextView) findViewById(R.id.);
//        textPosition.setText(String.valueOf(myPosition));
        TextView textPrice = (TextView) findViewById(R.id.price);
        textPrice.setText(String.valueOf(myPrice));
        TextView textSchedule = (TextView) findViewById(R.id.schedule);
        textSchedule.setText(String.valueOf(mySchedule));

        HideImages(myMotor,myCar,myAirplane,myShip);

        btnTour = (Button)findViewById(R.id.btnDatTour);
        btnTour.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(Intent.ACTION_VIEW);
                i.setData(Uri.parse(myReserve));
                startActivity(i);
            }
        });
    }

    public void HideImages(int motor, int car, int airplane, int ship) {
        imgMotor = (ImageView)findViewById(R.id.motor);
        imgCar = (ImageView)findViewById(R.id.car);
        imgAirplane = (ImageView)findViewById(R.id.airplane);
        imgShip = (ImageView)findViewById(R.id.ship);
        if (motor == 0)
            imgMotor.setVisibility(View.GONE);
        if (car == 0)
            imgCar.setVisibility(View.GONE);
        if (airplane == 0)
            imgAirplane.setVisibility(View.GONE);
        if (ship == 0)
            imgShip.setVisibility(View.GONE);
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
}
