using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace TripAdvisor.Controllers
{
    public class TourController : Controller
    {
        // GET: Tour
        public ActionResult Tour()
        {
            return View();
        }
        public ActionResult TourReservation()
        {
            return View();
        }
        public ActionResult ReviewOrder()
        {
            return View();
        }
        public ActionResult CheckOut()
        {
            return View();
        }
    }
}