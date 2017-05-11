package nhom33.travelassistant;

import android.content.Context;
import android.support.annotation.NonNull;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by Aki on 28/11/2016.
 */

public class HintAdapter extends ArrayAdapter<String> {
    private Context myContext;
    private ArrayList<String> myArray = new ArrayList<>();

    public HintAdapter(Context context, int resource, List<String> objects) {
        super(context, resource, objects);
        this.myContext = context;
        this.myArray = (ArrayList<String>) objects;
    }

    @Override
    public View getDropDownView(int position, View convertView, ViewGroup parent) {
        View view = null;
        if (position == myArray.size() - 1) {
            TextView myText = new TextView(myContext);
            myText.setVisibility(View.GONE);
            view = myText;
        } else {
            view = super.getDropDownView(position, null, parent);
        }
        return view;
    }
}
