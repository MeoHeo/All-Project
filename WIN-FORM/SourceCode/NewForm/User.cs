using learning_assitance;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace NewForm
{
    class User
    {
        private string user_name;
        private string pass;
        private string email;
        
        public string User_name {
            get
            {
                return user_name;
            }
            set
            {
                user_name = value;
            }
        }
        public string Pass {
            get
            {
                return pass;
            }
            set
            {
                pass = value;
            }
        }
        public string Email {
            get
            {
                return email;
            }
            set
            {
                email = value;
            }
        }

        public User(string user_name, string pass, string email)
        {
            this.user_name = user_name;
            this.pass = pass;
            this.email = email;
        }
        public bool addNewUser()
        {
            bool res = false;
            Database UserAccount = new Database();
            UserAccount.Sql = "create table if not exists user (user_name varchar(50), pass varchar(50), email varchar(50))";
            UserAccount.SetConnect("user.sqlite");
            UserAccount.ExcuteCommand("user.sqlite");

            //check user exited
            List<string> userList = new List<string>();
            UserAccount.Sql = "select user_name from user where user_name = '" + this.user_name + "'";
            UserAccount.ExcuteCommand("user.sqlite");
            while (UserAccount.sqlite_datareader.Read())
            {
                userList.Add(Convert.ToString(UserAccount.sqlite_datareader["user_name"]));
            }
            //UserAccount.sqlite_datareader.Close();
            if (userList.Count() == 0)
            {
                UserAccount.Sql = "insert into user (user_name, pass, email) values ('"
                    + this.user_name + "','" + this.pass + "','" + this.email + "')";
                UserAccount.ExcuteCommand("user.sqlite");
                UserAccount.closeConnect();
                MessageBox.Show("You have successfully registered and click \"OK\" to logged in", "Successfull",
                MessageBoxButtons.OK, MessageBoxIcon.Asterisk);
                res = true;
                //register.Visible = false;
                //login.Visible = true;
            }
            else
            {
                MessageBox.Show("Username was exited, please try again", "Error",
                MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            return res;
        }
    }
}
