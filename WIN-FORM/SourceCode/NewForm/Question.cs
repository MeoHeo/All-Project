using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace learning_assitance
{
    class Question
    {
        public string question;
        public string answer;
        public int repeat;
        public Question(string question, string answer, int repeat)
        {
            this.question = question;
            this.answer = answer;
            this.repeat = repeat;
        }
        public Question()
        {
            question = "";
            answer = "";
            repeat = 0;
        }
        public bool equal_q(Question other)
        {
            return other.question.Equals(question, StringComparison.Ordinal)
                && other.answer.Equals(answer, StringComparison.Ordinal)
                && other.repeat == repeat;
        }
        public bool check_exist_list(List<Question> lst)
        {
            bool res = false;
            foreach (var item in lst)
            {
                if (equal_q(item)) { res = true; break; }
            }
            return res;
        }
    }
}
