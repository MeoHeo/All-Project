using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SQLite;
using Excel = Microsoft.Office.Interop.Excel;
using System.Runtime.InteropServices;
using System.Text.RegularExpressions;
using System.IO;
using learning_assitance;
using System.Diagnostics;
using NewForm;


namespace NewForm
{
    public partial class LearningAssitance : Form
    {
        object misValue = System.Reflection.Missing.Value;
        String filePath;
        string sql;
        string key;
        string value;
        string repeat;
        int repeat_time;
        Excel.Application xlApp;
        Excel.Workbook xlWorkBook;
        Excel.Worksheet xlWorkSheet;
        Excel.Range range;
        SQLiteConnection m_dbConnection;
        SQLiteCommand command;
        string current_package_name;
        int index_choosed = 0;
        List<string> answer;
        Question question_chose;
        Question last_question_chose;
        List<Question> package;
        List<Question> list_question_nondistinct;
        int total_point;
        int current_right_answer;
        SQLiteDataReader reader;
        int right_ans;
        Stopwatch stopWatch = new Stopwatch();
        Package currentPackage;
        int total_question_asked = 0;

        private void chosePackage(string packge_name)
        {
            currentPackage = Package.getPackageByName(packge_name);
            start_topic_name.Text = currentPackage.topic;
            start_num_ques.Text = currentPackage.number_question.ToString();

            welcome.Visible = false;
            english.Visible = true;
            changeButton(btnBegin);
            changeButton(btnEdit);
            changeButton(btnBack);
            changeButton(start_topic_name);
            changeButton(start_num_ques);
            changeButton(btnTime);
            changeButton(btnLimit);
            label_start_pck_name.Text = currentPackage.package_name;
            label_playing_pck_name.Text = currentPackage.package_name;
        }

        public LearningAssitance()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            //FormBorderStyle = FormBorderStyle.None;
            WindowState = FormWindowState.Maximized;
            this.KeyPreview = true;
            this.KeyDown += new System.Windows.Forms.KeyEventHandler(Form_KeyDown);
        }
        private void Form_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Escape)
            {
                this.WindowState = FormWindowState.Normal;
            }
        }

        private void panel1_Paint(object sender, PaintEventArgs e)
        {

        }

        private void btnRegister_Click(object sender, EventArgs e)
        {
            register.Visible = true;
            login.Visible = false;

        }

        private void label14_Click(object sender, EventArgs e)
        {

        }
        public void changeButton(Button button)
        {
            button.TabStop = false;
            button.FlatStyle = FlatStyle.Flat;
            button.FlatAppearance.BorderSize = 0;
        }
        private void btnLogin_Click(object sender, EventArgs e)
        {
            Database UserAccount = new Database();
            UserAccount.SetConnect("user.sqlite");
            List<string> userNameList = new List<string>();
            List<string> passList = new List<string>();
            UserAccount.Sql = "select user_name from user";
            UserAccount.ExcuteCommand("user.sqlite");
            while (UserAccount.sqlite_datareader.Read())
            {
                userNameList.Add(Convert.ToString(UserAccount.sqlite_datareader["user_name"]));
            }
            UserAccount.Sql = "select pass from user";
            UserAccount.ExcuteCommand("user.sqlite");
            while (UserAccount.sqlite_datareader.Read())
            {
                passList.Add(Convert.ToString(UserAccount.sqlite_datareader["pass"]));
            }
            UserAccount.closeConnect();
            Boolean checkInfomation = false;
            for (int i = 0; i < userNameList.Count(); i++)
            {
                if (userNameList[i] == txtUserName.Text && passList[i] == txtPassword.Text)
                {
                    checkInfomation = true;
                    break;
                }
            }
            if (checkInfomation == true)
            {
                welcome.Visible = true;
                changeButton(btnPack1);
                changeButton(btnPack2);
                changeButton(btnPack3);
                changeButton(btnPack4);
                login.Visible = false;
                register.Visible = false;
                label_welcom.Text += txtUserName.Text;
                label_welcome2.Text += txtUserName.Text;
            }
            else
            {
                invalid.Visible = true;
                login.Visible = false;
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            login.Visible = true;
            register.Visible = false;
        }

        private void btnAcount_Click(object sender, EventArgs e)
        {

        }

        private void ptEnglish_Click(object sender, EventArgs e)
        {
            //english.Visible = true;
            //welcome.Visible = false;
            ////set none border for button
            //changeButton(btnPk_Setting);
            ////changeButton(btnPk_Account);
            //changeButton(btnBegin);
            //changeButton(btnEdit);
            //changeButton(btnBack);
            //changeButton(btnTopic);
            //changeButton(btnQuestion);
            //changeButton(btnTime);
            //changeButton(btnLimit);
            //===================================
        }

        private void btnPack4_Click(object sender, EventArgs e)
        {
            chosePackage(btnPack4.Text);
        }

        private void label10_Click(object sender, EventArgs e)
        {

        }

        private void btnBack_Click(object sender, EventArgs e)
        {
            welcome.Visible = true;
            english.Visible = false;
        }

        private void english_Paint(object sender, PaintEventArgs e)
        {

        }

        private void button4_Click(object sender, EventArgs e)
        {
            OpenFileDialog ofd = new OpenFileDialog();
            ofd.ShowDialog();
        }

        private void btnEdit_Click(object sender, EventArgs e)
        {
            english.Visible = false;
            edit.Visible = true;
            changeButton(btnEdit_Back);
            changeButton(btnEdit_Begin);
        }

        private void btnEdit_Back_Click(object sender, EventArgs e)
        {
            english.Visible = true;
            edit.Visible = false;
        }

        private void btnBegin_Exit_Click(object sender, EventArgs e)
        {
            english.Visible = true;
            begin.Visible = false;
        }

        private void btnStart_Click(object sender, EventArgs e)
        {
            stopWatch.Start();
            chosed_butoon.Enabled = true;
            this.timer1.Start();
            package = new List<Question>();
            m_dbConnection = new SQLiteConnection("Data Source=" + "data\\question\\data_" + current_package_name + ".sqlite;Version=3;");
            m_dbConnection.Open();
            sql = "select * from data_" + current_package_name + "_table";
            command = new SQLiteCommand(sql, m_dbConnection);
            reader = command.ExecuteReader();
            while (reader.Read())
            {
                key = reader["key"].ToString();
                value = reader["value"].ToString();
                repeat_time = Convert.ToInt32(reader["repeat"]);
                package.Add(new Question(key, value, repeat_time));
            }
            list_question_nondistinct = new List<Question>();
            list_question_nondistinct = LearningAssistantTool.create_list_question_nondistinct(package);

            question_chose = new Question();
            last_question_chose = new Question();

            total_point = list_question_nondistinct.Count();
            current_right_answer = 0;

            //Console.Clear();
            //Console.WriteLine("Da lam duoc {0}/{1} cau.", current_right_answer, total_point);
            current_complete_question.Text = current_right_answer.ToString() + "\\" + total_point.ToString();
            while (true)
            {
                list_question_nondistinct.Shuffle();
                question_chose = list_question_nondistinct.ElementAt(0);
                if (list_question_nondistinct.Distinct().Count() == 1) break;
                if (!question_chose.equal_q(last_question_chose)) break;
                //kiem tra truong hop list chi con 1 loai cau hoi
            }
            last_question_chose = list_question_nondistinct.ElementAt(0);
            package.Shuffle();
            //create list answer 
            answer = new List<string>();
            answer.Add(package.ElementAt(0).answer);
            answer.Add(package.ElementAt(1).answer);
            answer.Add(package.ElementAt(2).answer);
            if (answer.Exists(item => item.Equals(question_chose.answer, StringComparison.Ordinal)))
                answer.Add(package.ElementAt(3).answer);
            else
                answer.Add(question_chose.answer);

            //bool user_res = LearningAssistantTool.ask_user(question_chose, answer);

            answer.Shuffle();
            question_content.Text = question_chose.question;
            ans_A.Text = answer.ElementAt(0);
            ans_B.Text = answer.ElementAt(1);
            ans_C.Text = answer.ElementAt(2);
            ans_D.Text = answer.ElementAt(3);
        }
        
        private void btnEdit_Begin_Click(object sender, EventArgs e)
        {
            begin.Visible = true;
            edit.Visible = false;
            changeButton(btnStart);
        }

        private void btnBegin_Click(object sender, EventArgs e)
        {
            begin.Visible = true;
            changeButton(btnStart);
            english.Visible = false;
            current_package_name = label_start_pck_name.Text;
            chosed_butoon.Enabled = false;
            question_content.Text = "Câu hỏi";
            ans_A.Text = "Đáp án A";
            ans_B.Text = "Đáp án B";
            ans_C.Text = "Đáp án C";
            ans_D.Text = "Đáp án D";

        }

        private void button2_Click(object sender, EventArgs e)
        {
            SetStyle(ControlStyles.SupportsTransparentBackColor, true);
        }

        private void btnPk_Setting_Click(object sender, EventArgs e)
        {
            english.Visible = false;
            account.Visible = true;
        }

        private void btnSetting_Click(object sender, EventArgs e)
        {
            welcome.Visible = false;
            account.Visible = true;
        }

        private void btnPk_Account_Click(object sender, EventArgs e)
        {
            english.Visible = false;
            account.Visible = true;
        }

        private void btnAcount_Click_1(object sender, EventArgs e)
        {
            welcome.Visible = false;
            account.Visible = true;
        }
        
        private void button5_Click(object sender, EventArgs e)
        {
            account.Visible = false;
            welcome.Visible = true;
        }

        private void button3_Click(object sender, EventArgs e)
        {
            account.Visible = false;
            welcome.Visible = true;
        }

        private void button8_Click(object sender, EventArgs e)
        {
            result.Visible = false;
            begin.Visible = true;
            question_content.Text = "Câu hỏi";
            ans_A.Text = "Đáp án A";
            ans_B.Text = "Đáp án B";
            ans_C.Text = "Đáp án C";
            ans_D.Text = "Đáp án D";
        }

        private void button12_Click(object sender, EventArgs e)
        {
            OpenFileDialog ofd = new OpenFileDialog();
            ofd.ShowDialog();
        }

        private void btnAddPackge_Click(object sender, EventArgs e)
        {
            welcome.Visible = false;
            addPackage.Visible = true;
        }

        private void button13_Click(object sender, EventArgs e)
        {
            addPackage.Visible = false;
            begin.Visible = true;
        }

        private void button11_Click(object sender, EventArgs e)
        {
            addPackage.Visible = false;
            welcome.Visible = true;
        }

        private void button9_Click(object sender, EventArgs e)
        {
            OpenFileDialog ofd = new OpenFileDialog();
            ofd.Filter = "Excel Files|*.xls;*.xlsx;*.xlsm";
            ofd.ShowDialog();
            filePath = ofd.FileName;
            label_file_name.Text = "File name: " + Path.GetFileName(filePath);

            xlApp = new Excel.Application();
            try
            {
                xlWorkBook = xlApp.Workbooks.Open(filePath, 0, true, 5, "", "", true,
                Excel.XlPlatform.xlWindows, "\t", false, false, 0, true, 1, 0);
            } catch
            {
                return;
            }
            
            xlWorkSheet = (Excel.Worksheet)xlWorkBook.Worksheets.get_Item(1);
            
        }

        private void button14_Click(object sender, EventArgs e)
        {

        }

        private void btnTryAgain_Click(object sender, EventArgs e)
        {
            invalid.Visible = false;
            login.Visible = true;
        }

        private void button10_Click(object sender, EventArgs e)
        {
            //store new package
            //store question list
            Package newPackage = new Package(label_package_name.Text, Int32.Parse(input_num_question.Text), label_topic.Text);
            newPackage.addPackageToDatabase();


            SQLiteConnection.CreateFile("data\\question\\data_" + label_package_name.Text + ".sqlite");
            
            m_dbConnection = new SQLiteConnection("Data Source=" + "data\\question\\data_" + label_package_name.Text + ".sqlite;Version=3;");
            m_dbConnection.Open();
            sql = "create table " + "data_" + label_package_name.Text + "_table (key varchar(20), value varchar(20), repeat int)";
            command = new SQLiteCommand(sql, m_dbConnection);
            command.ExecuteNonQuery();
            Excel.Application xlApp;
            Excel.Workbook xlWorkBook;
            Excel.Worksheet xlWorkSheet;
            
            xlApp = new Excel.Application();
            xlWorkBook = xlApp.Workbooks.Open(filePath, 0, true, 5, "", "", true,
            Excel.XlPlatform.xlWindows, "\t", false, false, 0, true, 1, 0);

            xlWorkSheet = (Excel.Worksheet)xlWorkBook.Worksheets.get_Item(1);
            
            int num_question = Int32.Parse(input_num_question.Text);

            //one first in excel
            for (int i = 2; i < num_question+2; i++)
            {
                key = xlWorkSheet.Cells[i, 1].Value.ToString();
                value = xlWorkSheet.Cells[i, 2].Value.ToString();
                repeat = xlWorkSheet.Cells[i, 3].Value.ToString();
                sql = "insert into " + "data_" + label_package_name.Text + "_table (key, value , repeat) values ('" + key + "','" + value + "','" + repeat + "')";
                command = new SQLiteCommand(sql, m_dbConnection);
                command.ExecuteNonQuery();
            }

            xlWorkBook.Close(true, null, null);
            xlApp.Quit();

            Marshal.ReleaseComObject(xlWorkSheet);
            Marshal.ReleaseComObject(xlWorkBook);
            Marshal.ReleaseComObject(xlApp);
            m_dbConnection.Close();
            MessageBox.Show("Packet create succesfull", "Succesfull", MessageBoxButtons.OK, MessageBoxIcon.Information);
        }

        private void btnReg_Register_Click(object sender, EventArgs e)
        {
            Regex reg = new Regex(@"[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?"); ///Object initialization for Regex 
            if (txt_reg_username.Text == "" || txt_reg_pass.Text == "" || txt_reg_conf_pass.Text == ""
                || txt_reg_email.Text == "")
            {
                MessageBox.Show("Please fill all require information", "Erro",
                    MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else if (txt_reg_pass.TextLength < 8)
            {
                MessageBox.Show("Passwords must be at least 8 characters in length", "Erro",
                MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else if (txt_reg_pass.Text != txt_reg_conf_pass.Text)
            {
                MessageBox.Show("Confirm Password was invalid", "Erro",
                MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else if (!reg.IsMatch(txt_reg_email.Text))
            {
                MessageBox.Show("Email was invalid", "Error",
                MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            else
            {
                User new_user = new User(txt_reg_username.Text, txt_reg_pass.Text, txt_reg_email.Text);
                bool add_user_success = new_user.addNewUser();
                if (add_user_success)
                {
                    register.Visible = false;
                    login.Visible = true;
                }
            }
        }

        private void label16_Click(object sender, EventArgs e)
        {

        }

        private void btnA_Click(object sender, EventArgs e)
        {

        }

        private void button4_Click_1(object sender, EventArgs e)
        {
            
        }

        private void chosed_butoon_Click(object sender, EventArgs e)
        {
            total_question_asked++;
            //y
            right_ans = answer.FindIndex(a => a == question_chose.answer);
            if (radio_A.Checked) index_choosed = 0;
            if (radio_B.Checked) index_choosed = 1;
            if (radio_C.Checked) index_choosed = 2;
            if (radio_D.Checked) index_choosed = 3;

            if(index_choosed == right_ans)
            {
                MessageBox.Show("Đúng rồi nha!", "Succesfull", MessageBoxButtons.OK, MessageBoxIcon.Information);
                list_question_nondistinct.Remove(question_chose);
                current_right_answer++;
                current_complete_question.Text = current_right_answer.ToString() + "\\" + total_point.ToString();
            } else
            {
                MessageBox.Show("Sai mất rồi!", "Succesfull", MessageBoxButtons.OK, MessageBoxIcon.Warning);
            }
            //first_question = false;
            if (list_question_nondistinct.Count == 0)
            {
                MessageBox.Show("You was clean package!", "Succesfull", MessageBoxButtons.OK, MessageBoxIcon.Information);
                result.Visible = true;
                begin.Visible = false;
                stopWatch.Stop();
                TimeSpan ts = stopWatch.Elapsed;
                result_completion_time.Text = String.Format("{0:00}h:{1:00}m:{2:00}s", ts.Hours, ts.Minutes, ts.Seconds) + result_completion_time.Text;

                TimeSpan ts_per_question = new TimeSpan(ts.Ticks / total_point);
                result_sec_per_question.Text = String.Format("{0:00}h:{1:00}m:{2:00}s", ts_per_question.Hours, ts_per_question.Minutes, ts_per_question.Seconds) + result_sec_per_question.Text;

                double p_res = (total_question_asked - total_point) * 100 / total_question_asked;
                p_wrong.Text = Math.Round(p_res) + p_wrong.Text;
                total_question_asked = 0;
                return;
            }
            
            while (true)
            {
                list_question_nondistinct.Shuffle();
                question_chose = list_question_nondistinct.ElementAt(0);
                if (list_question_nondistinct.Distinct().Count() == 1) break;
                if (!question_chose.equal_q(last_question_chose)) break;
                //kiem tra truong hop list chi con 1 loai cau hoi
            }
            last_question_chose = list_question_nondistinct.ElementAt(0);
            package.Shuffle();
            //create list answer 
            answer = new List<string>();
            answer.Add(package.ElementAt(0).answer);
            answer.Add(package.ElementAt(1).answer);
            answer.Add(package.ElementAt(2).answer);
            if (answer.Exists(item => item.Equals(question_chose.answer, StringComparison.Ordinal)))
                answer.Add(package.ElementAt(3).answer);
            else
                answer.Add(question_chose.answer);

            //bool user_res = LearningAssistantTool.ask_user(question_chose, answer);

            answer.Shuffle();
            question_content.Text = question_chose.question;
            ans_A.Text = answer.ElementAt(0);
            ans_B.Text = answer.ElementAt(1);
            ans_C.Text = answer.ElementAt(2);
            ans_D.Text = answer.ElementAt(3);
            //check emty list question
            //if (list_question_nondistinct.Count == 0) break;
        }

        private void btnPack3_Click(object sender, EventArgs e)
        {
            chosePackage(btnPack3.Text);
        }

        private void btnPack2_Click(object sender, EventArgs e)
        {
            chosePackage(btnPack2.Text);
        }

        private void btnPack1_Click(object sender, EventArgs e)
        {
            chosePackage(btnPack1.Text);
        }
    }
}
