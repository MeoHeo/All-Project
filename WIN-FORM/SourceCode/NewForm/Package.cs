using System;
using System.Collections.Generic;
using System.Data.SQLite;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace NewForm
{
    class Package
    {
        public string package_name;
        public int number_question;
        public string topic;

        public Package(string package_name, int number_question, string topic)
        {
            this.package_name = package_name;
            this.number_question = number_question;
            this.topic = topic;
        }
        public void addPackageToDatabase()
        {
            SQLiteConnection m_dbConnection = new SQLiteConnection("Data Source=data\\list_package.sqlite;Version=3;");
            m_dbConnection.Open();
            string sql = string.Format("insert into list_package values ('{0}', '{1}', '{2}')", package_name, number_question, topic);
            SQLiteCommand command = new SQLiteCommand(sql, m_dbConnection);
            command.ExecuteNonQuery();
        }

        public static Package getPackageByName(string name)
        {
            SQLiteConnection m_dbConnection = new SQLiteConnection("Data Source=data\\list_package.sqlite;Version=3;");
            m_dbConnection.Open();
            string sql = string.Format("select * from list_package where package_name = '{0}'", name);
            SQLiteCommand command = new SQLiteCommand(sql, m_dbConnection);
            SQLiteDataReader reader = command.ExecuteReader();
            string pac_name = "";
            string topic = "";
            int num_ques = 0;
            while (reader.Read())
            {
                pac_name = reader["package_name"].ToString();
                topic = reader["topic"].ToString();
                num_ques = Convert.ToInt32(reader["number_question"]);
            }
            
            return new Package(pac_name, num_ques, topic);
        }
    }
}
