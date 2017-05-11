using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace TripAdvisor.Models
{
    public class TourImage
    {
        public int TourImageId { get; set; }
        public int TourId { get; set; }
        public int ImageId { get; set; }

    }
}