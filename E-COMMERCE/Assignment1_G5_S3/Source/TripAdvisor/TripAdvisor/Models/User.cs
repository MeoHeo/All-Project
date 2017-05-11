using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace TripAdvisor.Models
{
    public class User
    {
        public int UserId { get; set; }
        public string Username { get; set; }
        public string Password { get; set; }
        public string Firstname { get; set; }
        public string Lastname { get; set; }
        public string Email { get; set; }
        public string Address { get; set; }
        public string Phone { get; set; }
        public string CardFirstname { get; set; }
        public string CardLastName { get; set; }
        public string CardNumber { get; set; }
        public DateTime ExpireDate { get; set; }
        public string Country { get; set; }
        public string Note { get; set; }
    }
}