package nhom33.travelassistant;

import android.provider.BaseColumns;

/**
 * Created by MEW on 21/11/2016.
 */

public class Contract {
    private Contract() {
    }

    public static final class TinhThanh {
        public static final String TABLE_NAME = "tinhThanh";
        public static final String COLUMN_NAME_MATINH = "maTinh";
    }

    public static final class DiaDanh implements BaseColumns {
        public static final String TABLE_NAME = "diaDanh";
        public static final String COLUMN_NAME_MATINH = "maTinh";
        public static final String COLUMN_NAME_ID = _ID;
        public static final String COLUMN_NAME_TEN = "ten";
        public static final String COLUMN_NAME_DIACHI = "diaChi";
        public static final String COLUMN_NAME_HINHANH = "hinhAnh";
        public static final String COLUMN_NAME_GHICHU = "ghiChu";
    }

    public static final class NhaHang implements BaseColumns {
        public static final String TABLE_NAME = "nhaHang";
        public static final String COLUMN_NAME_MATINH = "maTinh";
        public static final String COLUMN_NAME_ID = _ID;
        public static final String COLUMN_NAME_TEN = "ten";
        public static final String COLUMN_NAME_DIACHI = "diaChi";
        public static final String COLUMN_NAME_SODIENTHOAI = "soDienThoai";
        public static final String COLUMN_NAME_HINHANH = "hinhAnh";
        public static final String COLUMN_NAME_GHICHU = "ghiChu";
    }

    public static final class KhachSan implements BaseColumns {
        public static final String TABLE_NAME = "khachSan";
        public static final String COLUMN_NAME_MATINH = "maTinh";
        public static final String COLUMN_NAME_ID = _ID;
        public static final String COLUMN_NAME_TEN = "ten";
        public static final String COLUMN_NAME_DIACHI = "diaChi";
        public static final String COLUMN_NAME_SODIENTHOAI = "soDienThoai";
        public static final String COLUMN_NAME_HINHANH = "hinhAnh";
        public static final String COLUMN_NAME_GHICHU = "ghiChu";
    }

    public static final class Tour implements BaseColumns {
        public static final String TABLE_NAME = "tour";
        public static final String COLUMN_NAME_MATINH = "maTinh";
        public static final String COLUMN_NAME_ID = _ID;
        public static final String COLUMN_NAME_TEN = "ten";
        public static final String COLUMN_NAME_DIADIEM_KHOIHANH = "diaChi";
        public static final String COLUMN_NAME_THOIGIAN_KHOIHANH = "thoiGianKhoiHanh";
        public static final String COLUMN_NAME_THOIGIAN_KETTHUC = "thoiGianKetThuc";
        public static final String COLUMN_NAME_DONVITOCHUC = "donViToChuc";
        public static final String COLUMN_NAME_GIATOUR = "giaTour";
        public static final String COLUMN_NAME_LICHTRINH = "lichTrinh";
        public static final String COLUMN_NAME_XEMAY = "xeMay";
        public static final String COLUMN_NAME_XEHOI = "xeHoi";
        public static final String COLUMN_NAME_MAYBAY = "mayBay";
        public static final String COLUMN_NAME_TAUTHUY = "tauThuy";
        public static final String COLUMN_NAME_DATTOUR = "datTour";
    }
}
