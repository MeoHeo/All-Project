package nhom33.travelassistant;

import android.content.Context;
import android.database.Cursor;
import android.support.v4.widget.CursorAdapter;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import java.util.ArrayList;

/**
 * Created by Aki on 30/11/2016.
 * Adapter bind data từ Db lên GridView activity_choose_item_location.xml dùng layout one_item_location.xml
 */

class PlacesGridViewAdapter extends CursorAdapter {
    private Context myContext;
    private int layoutResourceId;
    private ArrayList myData = new ArrayList();


    PlacesGridViewAdapter(Context context, Cursor c, int flags) {
        super(context, c, flags);

    }

    @Override
    public View newView(Context context, Cursor cursor, ViewGroup parent) {
        LayoutInflater inflater = LayoutInflater.from(context);
        View view =  inflater.inflate(R.layout.one_item_location, parent, false);

        ViewHolder holder = new ViewHolder();
        holder.image = (ImageView) view.findViewById(R.id.item_image);
        holder.address = (TextView) view.findViewById(R.id.item_address);
        holder.name = (TextView) view.findViewById(R.id.item_name);
        view.setTag(holder);

        return view;
    }

    @Override
    public void bindView(View view, Context context, Cursor cursor) {
        ViewHolder holder = (ViewHolder) view.getTag();

        // cẩn thận trường hợp tên cột (hinhAnh, diaChi, ghiChu) khác nhau giữa các bảng (Địa danh/Nhà hàng/Khách Sạn/Tour)
        int myId = cursor.getInt(cursor.getColumnIndex("_id"));
        String myImageName = cursor.getString(cursor.getColumnIndexOrThrow("hinhAnh"));
        String myName = cursor.getString(cursor.getColumnIndexOrThrow("ten"));
        String myAddress = cursor.getString(cursor.getColumnIndexOrThrow("diaChi"));

        if (myImageName != null) {
            int myImageResId = context.getResources().getIdentifier(myImageName, "drawable", context.getPackageName());
            holder.image.setImageResource(myImageResId);
        }
        else {
            // dặt ảnh mặc định là ic_launcher nếu không tìm thấy tên ảnh trong Db
            holder.image.setImageResource(R.mipmap.ic_launcher);
        }
        holder.address.setText(myAddress);
        holder.name.setText(myName);

    }

    private static class ViewHolder {
        ImageView image;
        TextView address;
        TextView name;
    }
}
