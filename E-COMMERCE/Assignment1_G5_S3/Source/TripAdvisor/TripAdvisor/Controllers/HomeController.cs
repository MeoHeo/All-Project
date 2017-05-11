using System;
using System.Collections.Generic;
using System.Linq;
using System.Reflection;
using System.Web;
using System.Web.Mvc;

namespace TripAdvisor.Controllers
{
    public class HomeController : Controller
    {
        // GET: Home
        public ActionResult HomePage()
        {
            return View();
        }
        public ActionResult HomePageLogin()
        {
            return View();
        }
        public ActionResult Guidelines()
        {
            return View();
        }
    }
}