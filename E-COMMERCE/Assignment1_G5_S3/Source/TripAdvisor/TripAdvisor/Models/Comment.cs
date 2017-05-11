using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace TripAdvisor.Models
{
    public class Comment
    {
        public int CommentId { get; set; }
        public int UserId { get; set; }
        public int TourId { get; set; }
        public string Content { get; set; }
        public DateTime CommentDate { get; set; }
    }
}