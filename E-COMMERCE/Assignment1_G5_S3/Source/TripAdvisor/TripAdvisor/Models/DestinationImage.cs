using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace TripAdvisor.Models
{
    public class DestinationImage
    {
        public int DestinationImageId { get; set; }
        public int DestinationId { get; set; }
        public int ImageId { get; set; }
    }
}