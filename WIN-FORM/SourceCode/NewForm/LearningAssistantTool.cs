using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Security.Cryptography;

namespace learning_assitance
{
    static class LearningAssistantTool
    {
        public static void Shuffle<T>(this IList<T> list)
        {
            RNGCryptoServiceProvider provider = new RNGCryptoServiceProvider();
            int n = list.Count;
            while (n > 1)
            {
                byte[] box = new byte[1];
                do provider.GetBytes(box);
                while (!(box[0] < n * (Byte.MaxValue / n)));
                int k = (box[0] % n);
                n--;
                T value = list[k];
                list[k] = list[n];
                list[n] = value;
            }
        }
        public static List<Question> create_list_question_nondistinct(List<Question> package)
        {
            List<Question> res = new List<Question>();
            foreach (var item in package)
            {
                for (int i = 0; i < item.repeat; i++) res.Add(item);
            }
            return res;
        }
    }
}
