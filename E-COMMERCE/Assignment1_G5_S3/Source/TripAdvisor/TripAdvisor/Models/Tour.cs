using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace TripAdvisor.Models
{
    public class Tour
    {
        public int TourId { get; set; }
        public int CompanyId { get; set; }
        public int UserId { get; set; }
        public string Name { get; set; }
        public List<DateTime> StartingDate { get; set; }
        public List<DateTime> EndingDate { get; set; }
        public float Price { get; set; }
        public string Location { get; set; }
        public string Duration { get; set; }
        public string Itinerary { get; set; }
        public string Description { get; set; }
        public string TourImageId { get; set; }
        public int RatingId { get; set; }
        public int BookedQuantity { get; set; }
        public string Type { get; set; }
    }
}