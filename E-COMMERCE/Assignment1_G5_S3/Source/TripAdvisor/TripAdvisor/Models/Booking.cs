using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace TripAdvisor.Models
{
    public class Booking
    {
        public int BookingId { get; set; }
        public int UserId { get; set; }
        public List<int> TourIdList { get; set; }
        public DateTime BookingDate { get; set; }
        public int CustomerQuantity { get; set; }
        public string PurchasedType { get; set; }
        public string Firstname { get; set; }
        public string Lastname { get; set; }
        public string Email { get; set; }
        public string Address { get; set; }
        public string Phone { get; set; }
        public string CardNumber { get; set; }
        public DateTime ExpireDate { get; set; }
        public string Country { get; set; }
        public string Type { get; set; }

    }
}