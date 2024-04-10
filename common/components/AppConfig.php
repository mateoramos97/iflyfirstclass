<?php

namespace common\components;

abstract class AppConfig
{
    //site config
    const limit_number_page_visits_flight_request_page = 1;

    /* img params */
    const Image_ContentType_BlogArticle = 1;
    const Image_ContentField_BlogArticle = 1;

    const Image_ContentType_Continent = 3;
    const Image_ContentField_Continent = 3;

    const Image_ContentType_Country = 4;
    const Image_ContentField_Country = 4;

    const Image_ContentType_City = 5;
    const Image_ContentField_City = 5;

    const Image_ContentType_Airline = 6;
    const Image_ContentField_Airline = 6;

    const Image_ContentType_TravelTips = 7;
    const Image_ContentField_TravelTips = 7;

    const Image_ContentType_TravelTipsAttactions = 8;
    const Image_ContentField_TravelTipsAttactions = 8;

    const Image_ContentType_Testimonials = 9;
    const Image_ContentField_Testimonials = 9;

    const Image_ContentType_DirectionsCities = 10;
    const Image_ContentField_DirectionsCities = 10;

    /*type trip*/
    const Type_Trip_Round_Trip = 1;
    const Type_Trip_One_Way = 2;
    const Type_Trip_Multi_City = 3;

    /*cabin class*/
    const Cabin_Class_Business = 1;
    const Cabin_Class_First = 2;

    /*static page*/
    const Home_Page = 1;
    const Business_Class_Page = 2;
    const First_Class_Page = 3;
    const Hotels_Page = 5;
    const Blog_Page = 6;
    const Travel_Tips_Page = 7;
    const About_Us_Page = 8;
    const Flight_Request_Page = 9;
    const Last_Minute_Deals = 11;
    const Flight_Tracker_Page = 13;
    const Visa_Page = 14;
    const Request_Quote_Page = 15;
    const Corporate_Accounts_Page = 16;
    const Testimonials_Page = 17;

    const Message_DuplicateAlias = "Alias already exists.";
}