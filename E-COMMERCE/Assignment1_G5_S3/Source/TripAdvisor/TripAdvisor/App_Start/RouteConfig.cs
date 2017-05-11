using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Web.Routing;

namespace TripAdvisor
{
    public class RouteConfig
    {
        public static void RegisterRoutes(RouteCollection routes)
        {
            routes.IgnoreRoute("{resource}.axd/{*pathInfo}");
       
            routes.MapRoute(
                name: "Default",
                url: "{controller}/{action}/{id}",
                defaults: new { controller = "Home", action = "HomePage", id = UrlParameter.Optional }
            );//view dau tien dc load len 
            routes.MapRoute(
                name: "Guidelines",
                url: "{controller}/{action}/{id}",
                defaults: new { controller = "Home", action = "Guidelines", id = UrlParameter.Optional }
            );
            routes.MapRoute(
                name: "HomeLogin",
                url: "{controller}/{action}/{id}",
                defaults: new { controller = "Home", action = "HomePageLogin", id = UrlParameter.Optional }
            );
            routes.MapRoute(
               name: "Destination",
               url: "{controller}/{action}/{id}",
               defaults: new { controller = "Destination", action = "Destination", id = UrlParameter.Optional }
            );
            routes.MapRoute(
               name: "Tour",
               url: "{controller}/{action}/{id}",
               defaults: new { controller = "Tour", action = "Tour", id = UrlParameter.Optional }
            );
            routes.MapRoute(
               name: "DetailTour",
               url: "{controller}/{action}/{id}",
               defaults: new { controller = "Detail", action = "DetailTour", id = UrlParameter.Optional }
            );
            routes.MapRoute(
              name: "DetailDestination",
              url: "{controller}/{action}/{id}",
              defaults: new { controller = "Detail", action = "DetailDestination", id = UrlParameter.Optional }
           );
            routes.MapRoute(
             name: "Search",
             url: "{controller}/{action}/{id}",
             defaults: new { controller = "Search", action = "Search", id = UrlParameter.Optional }
          );
            routes.MapRoute(
            name: "TourReservation",
            url: "{controller}/{action}/{id}",
            defaults: new { controller = "Tour", action = "TourReservation", id = UrlParameter.Optional }
          );
            routes.MapRoute(
           name: "ReviewOrder",
           url: "{controller}/{action}/{id}",
           defaults: new { controller = "Tour", action = "ReviewOrder", id = UrlParameter.Optional }
         );
            routes.MapRoute(
          name: "CheckOut",
          url: "{controller}/{action}/{id}",
          defaults: new { controller = "Tour", action = "CheckOut", id = UrlParameter.Optional }
         );
            routes.MapRoute(
        name: "UploadTour",
        url: "{controller}/{action}/{id}",
        defaults: new { controller = "UploadTour", action = "UploadTour", id = UrlParameter.Optional }
        );
            routes.MapRoute(
       name: "AccountInfo",
       url: "{controller}/{action}/{id}",
       defaults: new { controller = "Account", action = "AccountInfo", id = UrlParameter.Optional }
       );
           
        }
    }
}
