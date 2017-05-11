using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace TripAdvisor.Models
{
    public class Destination
    {
        public int DestinationId { get; set; }
        public string Name { get; set; }
        public string Content { get; set; }
        public int DestinationImageId { get; set; }
    }
}