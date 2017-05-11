package nhom33.travelassistant;

import android.content.Intent;
import android.database.Cursor;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.Spinner;

public class ChooseItemLocation extends BaseActivity {
    public static final String ARG_PLACES_ID = "nhom33.travelassistant.placesId";
    GridView gridView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_choose_item_location);

        int selectedPosition = getIntent().getExtras().getInt(ARG_SPINNER_POSITION);
        setSpinnerPosition(selectedPosition);
        String selectedTinhThanh = getSpinnerItemName();

        final String placeType = getIntent().getExtras().getString(ChooseLocation.ARG_PLACE_TYPE);


        gridView = (GridView) findViewById(R.id.tinh_thanh_grid_view);
        Cursor c;

        if (placeType.equals(getResources().getString(R.string.tour_text))){
            c = myDbHelper.getPlacesInfo(Contract.Tour.TABLE_NAME, selectedTinhThanh);
        } else if (placeType.equals(getResources().getString(R.string.nha_hang_text))){
            c = myDbHelper.getPlacesInfo(Contract.NhaHang.TABLE_NAME, selectedTinhThanh);
        } else if (placeType.equals(getResources().getString(R.string.khach_san_text))){
            c = myDbHelper.getPlacesInfo(Contract.KhachSan.TABLE_NAME, selectedTinhThanh);
        } else {
            c = myDbHelper.getPlacesInfo(Contract.DiaDanh.TABLE_NAME, selectedTinhThanh);
        }


        PlacesGridViewAdapter adapter = new PlacesGridViewAdapter(this, c, 0);
        gridView.setAdapter(adapter);

        gridView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                Cursor c = (Cursor) adapterView.getItemAtPosition(i);
                Intent intent;
                if (placeType.equals(getResources().getString(R.string.tour_text))){
                    intent = new Intent(ChooseItemLocation.this, DetailTourActivity.class);
                } else {
                    intent = new Intent(ChooseItemLocation.this, DetailServiceActivity.class);
                }
                intent.putExtra(ChooseLocation.ARG_PLACE_TYPE, placeType);
                intent.putExtra(ARG_PLACES_ID, c.getInt(c.getColumnIndexOrThrow("_id")));
                startActivity(intent);
            }
        });
    }
}
