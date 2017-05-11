package nhom33.travelassistant;

import android.content.Context;
import android.content.res.Resources;
import android.support.v7.widget.AppCompatSpinner;
import android.util.AttributeSet;
import android.widget.Spinner;

/**
 * Created by Aki on 28/11/2016.
 */

public class CustomSpinner extends AppCompatSpinner {

    private boolean mToggleFlag = true;

    public CustomSpinner(Context context) {
        super(context);
    }

    public CustomSpinner(Context context, int mode) {
        super(context, mode);
    }

    public CustomSpinner(Context context, AttributeSet attrs) {
        super(context, attrs);
    }

    public CustomSpinner(Context context, AttributeSet attrs, int defStyleAttr) {
        super(context, attrs, defStyleAttr);
    }

    public CustomSpinner(Context context, AttributeSet attrs, int defStyleAttr, int mode) {
        super(context, attrs, defStyleAttr, mode);
    }

    @Override
    public int getSelectedItemPosition() {
        if (!mToggleFlag) {
            return 0; // Gets to the first element
        }
        return super.getSelectedItemPosition();
    }

    @Override
    public boolean performClick() {
        mToggleFlag = false;
        boolean result = super.performClick();
        mToggleFlag = true;
        return result;
    }

}