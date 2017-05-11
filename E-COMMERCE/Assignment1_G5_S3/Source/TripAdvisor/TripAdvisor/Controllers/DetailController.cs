using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace TripAdvisor.Controllers
{
    public class DetailController : Controller
    {
        // GET: Detail
        public ActionResult DetailTour()//ten action trung voi ten view return
        {
            return View();
        }
        public ActionResult DetailDestination()
        {
            return View();
        }
    }
}