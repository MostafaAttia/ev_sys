//
//  URLS.swift
//  Vitee-ios
//
//  Created by Moon Moon on 7/1/15.
//  Copyright (c) 2015 Vitee. All rights reserved.
//

struct URLS{
    
    // ============================================================================= \\
    // URL BASE
    // ============================================================================= \\
    
    static func isDev() -> Bool {return SUB_DOMAIN == DEV}
    static func isStaging() -> Bool {return SUB_DOMAIN == STAGING}
    static func isProduction() -> Bool {return SUB_DOMAIN == PRODUCTION}
    
    
    // BASE URLs
    // =========
    static let
    
    DEV = "dev",
    STAGING = "STAGING",
    PRODUCTION = "www",
    
    SUB_DOMAIN = DEV,
    BASE = "http://" + SUB_DOMAIN + ".vitee.net/",
    //IMG_BASE = "http://d2uhknnrrb38zd.cloudfront.net/",
    IMG_BASE = "http://vcdn.vitee.net/",
    VIT = BASE + "vit_globalPDO/",
    
    
    // USER DIRECTORIES
    // ======================
    VIT_USER = VIT + "user/",
    USER_SINGLE = VIT_USER + "sin/",
    USER_LOGIN = USER_SINGLE + "login/",
    USER_PASSWORD = USER_LOGIN + "password/",
    USER_EDIT = USER_SINGLE + "edit/",
    USER_EMAIL = USER_SINGLE + "email/",
    USER_MULTIPLE = VIT_USER + "mul/",
    
    
    // EVENT DIRECTORIES
    // ========================
    VIT_EVENT = VIT + "event/",
    EVENT_SINGLE = VIT_EVENT + "sin/",
    EVENT_EDIT = EVENT_SINGLE + "edit/",
    EVENT_MULTIPLE = VIT_EVENT + "mul/",
    
    
    // COMMENT DIRECTORIES
    // ============================
    VIT_COMMENT = VIT + "comment/",
    COMMENT_SINGLE = VIT_COMMENT + "sin/",
    COMMENT_MULTIPLE = VIT_COMMENT + "mul/",
    
    
    // TICKET DIRECTORIES
    // ==========================
    VIT_TICKET = VIT + "ticket/",
    TICKET_EVENT = VIT_TICKET + "event/",
    TICKET_USER = VIT_TICKET + "user/",
    
    
    // MISC DIRECTORIES
    // ========================
    VIT_MEDIA = VIT + "media/",
    IMG = IMG_BASE + "img/",
    IMG_EVENT = IMG + "event/",
    IMG_USER = IMG + "user/",
    IMG_CATEGORY = IMG + "category/",
    IMG_ICONS = IMG_CATEGORY + "icons/",
    
    
    
    // ============================================================================= \\
    // URLS
    // ============================================================================= \\
    
    
    // USER LOGIN URLS
    // ---------------------------------------------------
    USER_CREATE_ACCOUNT = USER_LOGIN + "login_normal.php",                  // Done
    USER_CREATE = USER_LOGIN + "login_facebook.php",                        // Done
    USER_CREATE_GOOGLE = USER_LOGIN + "login_google.php",                   // Done
    USER_LOGOUT_GOOGLE = USER_LOGIN + "logout.php",                         // Done
    
    
    // USER URLS
    // -------------------------------------------
    USER_FORGOT_PASSWORD = USER_PASSWORD + "password_reset_request.php",    // Done
    USER_SEND_EMAIL = USER_EMAIL + "email_send_one.php",                    // Deprecated
    
    
    // USER EDIT URLS
    // ---------------------------------------------------
    USER_GET_DETAILS = USER_EDIT + "user_get_details.php",                  // Done

    USER_UPDATE_DETAILS = USER_EDIT + "user_update.php",                    // Done
    
    
    // USER LIST URLS
    // -------------------------------------------------------------
    USERS_GET_ATTENDING = USER_MULTIPLE + "users_get_attending.php",        // Done
    USERS_SEARCH = USER_MULTIPLE + "users_search.php",                      // Deprecated
    
    
    // EVENT URLS
    // -----------------------------------------------------
    EVENT_GET_DATA = EVENT_SINGLE + "event_get_details.php",                // Done
    EVENT_CHECK_ATTEND = EVENT_SINGLE + "event_check_attend.php",           // Deprecated
    EVENT_ATTEND = EVENT_SINGLE + "event_attend.php",                       // Deprecated
    EVENT_UNATTEND = EVENT_SINGLE + "event_unattend.php",                   // Deprecated
    
    
    // EVENT EDIT URLS
    // --------------------------------------------
    EVENT_GET_DETAILS = EVENT_EDIT + "event_get_details.php",               // Deprecated
    
    
    // EVENT LIST URLS
    // ---------------------------------------------------------------------
    EVENTS_GET_CATEGORIES = EVENT_MULTIPLE + "get_categories.php",          // Done
    EVENTS_GET_ALL = EVENT_MULTIPLE + "events_get_by_category.php",         // Done
    EVENTS_GET_GEO = EVENT_MULTIPLE + "events_get_by_geo.php",              // Done, by venue name
    EVENTS_SEARCH = EVENT_MULTIPLE + "events_search.php",                   // Done, by venue name, title, address
    EVENTS_GET_CREATED = EVENT_MULTIPLE + "events_get_my_events.php",       // Deprecated
    EVENTS_GET_ATTENDING = EVENT_MULTIPLE + "events_get_my_attending.php",  // Deprecated
    EVENTS_GET_BOOKMARKED = EVENT_MULTIPLE + "events_get_bookmarked.php",   // Deprecated
    
    
    // COMMENT URLS
    // -------------------------------------------------
    COMMENT_GET = COMMENT_MULTIPLE + "comments_get.php",
    COMMENT_CREATE = COMMENT_SINGLE + "comment_create.php",
    COMMENT_EDIT = COMMENT_SINGLE + "comment_edit.php",
    
    
    // MEDIA URLS
    // -------------------------------------------------
    MEDIA_UPLOAD_FILES = VIT_MEDIA + "media_upload.php",
    MEDIA_REMOVE_FILES = VIT_MEDIA + "media_remove.php",
    
    
    // TICKET LIST URLS
    // ------------------------------------------
    TICKETS_GET_MY = TICKET_USER + "getMyTickets.php",                      // Done
    TICKETS_GET = TICKET_USER + "tickets_get.php",                          // Done
    TICKETS_GET_INFO = TICKET_EVENT + "tickets_get_stock.php",              // Deprecated
    
    
    // TICKET URLS
    // ----------------------------------------------
    TICKET_CHECK = TICKET_USER + "ticket_check_hashkey.php",
    TICKET_PURCHASE = TICKET_EVENT + "purchase_ticket.php",
    TICKET_GENERATE = TICKET_EVENT + "purchase_ticket_three.php",
    TICKET_GET_DETAILS = TICKET_USER + "ticket_get_details.php",
    TICKET_PURCHASE_CRON = TICKET_EVENT + "reserve_ticket_cron.php";
    
    
    
    // ============================================================================= \\
    // EVENT IMAGES
    // ============================================================================= \\
    
    
    // IMAGE
    // ====================================================================
    static func getImageNSURL(eventId: Int, eventImage: String) -> NSURL? {
        return NSURL(string: getImageURL(eventId, eventImage: eventImage))
    }
    static func getImageURL(eventId: Int, eventImage: String) -> String {
        print(IMG_EVENT + eventId + "/" + eventImage)
        return IMG_EVENT + eventId + "/" + eventImage
    }
    
    
    // HEADER
    // =====================================================================
    static func getHeaderNSURL(eventId: Int, eventImage: String) -> NSURL? {
        return NSURL(string: getHeaderURL(eventId, eventImage: eventImage))
    }
    static func getHeaderURL(eventId: Int, eventImage: String) -> String {
        print(IMG_EVENT + eventId + "/header/" + eventImage)
        return IMG_EVENT + eventId + "/header/" + eventImage
    }
    
    
    // THUMBNAIL
    // ====================================================================
    static func getThumbNSURL(eventId: Int, eventImage: String) -> NSURL? {
        return NSURL(string: getThumbURL(eventId, eventImage: eventImage))
    }
    static func getThumbURL(eventId: Int, eventImage: String) -> String {
        print(IMG_EVENT + eventId + "/thumbnails/" + eventImage)
        return IMG_EVENT + eventId + "/thumbnails/" + eventImage
    }
    
    
    
    // ============================================================================= \\
    // PROFILE IMAGES
    // ============================================================================= \\
    
    
    // THUMBNAIL
    // =======================================================================
    static func getProfileImgNSURL(userId: Int, userImage: String) -> NSURL? {
        return NSURL(string: getProfileImgURL(userId, userImage: userImage))
    }
    static func getProfileImgURL(userId: Int, userImage: String) -> String {
        print(IMG_USER + userId + "/" + userImage)
        return IMG_USER + userId + "/" + userImage
    }
    
    
    
    // ============================================================================= \\
    // CATEOGRY IMAGES AND ICONS
    // ============================================================================= \\
    
    
    // THUMBNAIL
    // ==================================================
    static func getCatNSURL(category: String) -> NSURL? {
        return NSURL(string: getCatURL(category))
    }
    static func getCatURL(category: String) -> String {
        let cat = category
            .stringByReplacingOccurrencesOfString("&", withString: "and")
            .stringByAddingPercentEncodingWithAllowedCharacters(NSCharacterSet.URLQueryAllowedCharacterSet())
        
        
        print(IMG_CATEGORY + cat + ".jpg")
        return IMG_CATEGORY + cat + ".jpg"
    }
    
    
    // THUMBNAIL
    // ==================================================
    static func getCatIconNSURL(category: String) -> NSURL? {
        return NSURL(string: getCatIconURL(category))
    }
    static func getCatIconURL(category: String) -> String {
        let cat = category
            .stringByReplacingOccurrencesOfString("&", withString: "and")
            .stringByAddingPercentEncodingWithAllowedCharacters(NSCharacterSet.URLQueryAllowedCharacterSet())
        
        
        print(IMG_ICONS + "mdpi/" + cat + ".png")
        return IMG_ICONS + "mdpi/" + cat + ".png"
    }
    
}
