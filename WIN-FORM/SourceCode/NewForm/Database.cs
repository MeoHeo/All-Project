using System;
using System.Collections.Generic;
using System.Data.SQLite;
using System.IO;
using System.Linq;
using System.Runtime.Remoting.Contexts;
using System.Text;
using System.Threading.Tasks;

namespace learning_assitance
{
    class Database
    {
        // Here you define properties: OK
        SQLiteConnection sqlite_conn;
        public SQLiteCommand sqlite_cmd;
        public SQLiteDataReader sqlite_datareader;
        string sql;

        public string Sql
        {
            get
            {
                return sql;
            }

            set
            {
                sql = value;
            }
        }

        public Boolean doesDatabaseExist(String dbName)
        {
            string curFile = @"data\" + dbName;
            if (File.Exists(curFile))
                return true;
            else
                return false;
        }
        public void SetConnect(String dbName)
        {
            if (doesDatabaseExist(dbName) == false)
            {
                sqlite_conn = new SQLiteConnection("Data Source=" + "data\\" + dbName + ";Version=3; New=True;");
            }
            else
            {
                sqlite_conn = new SQLiteConnection("Data Source=" + "data\\" + dbName + ";Version=3;");
            }
            sqlite_conn.Open();
        }
        public void ExcuteCommand(String dbName)
        {
            sqlite_cmd = new SQLiteCommand(sql, sqlite_conn);
            sqlite_datareader = sqlite_cmd.ExecuteReader();
        }
        public void closeConnect()
        {
            sqlite_conn.Close();
        }
    }
}
