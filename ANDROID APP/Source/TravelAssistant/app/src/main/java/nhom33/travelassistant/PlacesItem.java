package nhom33.travelassistant;

import android.graphics.Bitmap;

/**
 * Created by Aki on 30/11/2016.
 */

public class PlacesItem {
    private Bitmap image;
    private String address;
    private String description;

    public PlacesItem(Bitmap image, String address, String description) {
        super();
        this.image = image;
        this.address = address;
        this.description = description;
    }

    public Bitmap getImage() {
        return image;
    }

    public void setImage(Bitmap image) {
        this.image = image;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }
}
