package nhom33.travelassistant;

import android.content.Context;
import android.database.Cursor;
import android.database.SQLException;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteException;
import android.database.sqlite.SQLiteOpenHelper;

import nhom33.travelassistant.Contract.TinhThanh;

import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.util.ArrayList;

/**
 * Created by MEW on 21/11/2016.
 */

public class DbHelper extends SQLiteOpenHelper {

    private static String DB_NAME = "Database.db";
    private static int DB_VERSION = 1;
    private static String DB_PATH = "/data/data/nhom33.travelassistant/databases/";
    private final Context myContext;
    private SQLiteDatabase myDataBase;

    public DbHelper(Context context) {
        super(context, DB_NAME, null, 1);
        this.myContext = context;
    }

    public void createDataBase() throws IOException {
        boolean dbExist = checkDataBase();
        if (!dbExist) {
            this.getReadableDatabase();
            try {
                copyDataBase();
            } catch (IOException e) {
                throw new Error("Error copying database");
            }
        }
    }

    private boolean checkDataBase() {
        SQLiteDatabase checkDB = null;
        try {
            String myPath = DB_PATH + DB_NAME;
            checkDB = SQLiteDatabase.openDatabase(myPath, null, SQLiteDatabase.OPEN_READONLY);
        } catch (SQLiteException e) {

        }

        if (checkDB != null) {
            checkDB.close();
        }
        return checkDB != null;
    }

    private void copyDataBase() throws IOException {
        InputStream myInput = myContext.getAssets().open(DB_NAME);
        String outFileName = DB_PATH + DB_NAME;
        OutputStream myOutput = new FileOutputStream(outFileName);

        byte[] buffer = new byte[1024];
        int length;
        while ((length = myInput.read(buffer)) > 0) {
            myOutput.write(buffer, 0, length);
        }

        myOutput.flush();
        myOutput.close();
        myInput.close();
    }

    public void openDataBase() throws SQLException {
        String myPath = DB_PATH + DB_NAME;
        myDataBase = SQLiteDatabase.openDatabase(myPath, null, SQLiteDatabase.OPEN_READONLY);
    }

    @Override
    public synchronized void close() {
        if (myDataBase != null)
            myDataBase.close();
        super.close();
    }

    public ArrayList<String> getTinhThanh() {
        myDataBase = getReadableDatabase();
        String query = "SELECT * FROM " + TinhThanh.TABLE_NAME;
        Cursor c = myDataBase.rawQuery(query, null);
        c.moveToFirst();

        ArrayList<String> myArray = new ArrayList<String>();
        while (!c.isAfterLast()) {
            myArray.add(c.getString(c.getColumnIndex(TinhThanh.COLUMN_NAME_MATINH)));
            c.moveToNext();
        }
        c.close();
        myDataBase.close();
        return myArray;
    }
//    public String getImageName(String selectedTinhThanh){
//        myDataBase = getReadableDatabase();
//        String query = "SELECT hinhAnh FROM " + TinhThanh.TABLE_NAME + " WHERE " +
//                TinhThanh.COLUMN_NAME_MATINH + " = '" + selectedTinhThanh + "'";
//
//        Cursor c = myDataBase.rawQuery(query, null);
//        c.moveToFirst();
//        String myImageName = c.getString(c.getColumnIndexOrThrow("hinhAnh"));
//        return myImageName;
//    }

    public Cursor getPlacesInfo(String TABLE_NAME, String selectedTinhThanh) {
        myDataBase = getReadableDatabase();
        String idCol = "";
        switch (TABLE_NAME) {
            case Contract.DiaDanh.TABLE_NAME: {
                idCol += "idDiaDanh";
                break;
            }
            case Contract.NhaHang.TABLE_NAME: {
                idCol += "idNhaHang";
                break;
            }
            case Contract.KhachSan.TABLE_NAME: {
                idCol += "idKhachSan";
                break;
            }
            case Contract.Tour.TABLE_NAME: {
                idCol += "idTour";
                break;
            }
        }
        String query = "SELECT " + idCol + " as _id, * FROM " + TABLE_NAME + " WHERE maTinh = '" + selectedTinhThanh + "'";
        Cursor c = myDataBase.rawQuery(query, null);
        c.moveToFirst();
        myDataBase.close();
        return c;
    }

    public Cursor getItemInfo(int id, String TABLE_NAME) {
        myDataBase = getReadableDatabase();
        String idCol = "";
        switch (TABLE_NAME) {
            case Contract.DiaDanh.TABLE_NAME: {
                idCol += "idDiaDanh";
                break;
            }
            case Contract.NhaHang.TABLE_NAME: {
                idCol += "idNhaHang";
                break;
            }
            case Contract.KhachSan.TABLE_NAME: {
                idCol += "idKhachSan";
                break;
            }
            case Contract.Tour.TABLE_NAME: {
                idCol += "idTour";
                break;
            }
        }
        //String[] columns = new String[]{col};
        String whereClause = idCol + " = ?";
        String[] whereArgs = new String[] {String.valueOf(id)};
        //String query = "SELECT " + idCol + " as _id, * FROM " + TABLE_NAME;
        //Cursor c = myDataBase.rawQuery(query, null);
        Cursor c = myDataBase.query(TABLE_NAME,null,whereClause,whereArgs,null,null,null);
        c.moveToFirst();
        //myDataBase.close();
        return c;
    }



    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {

    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {

    }
}
