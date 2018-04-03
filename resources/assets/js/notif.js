window._ = require('lodash');

var notifications = [];

const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\OrganiserFollowed',
    newEventFromOrganiser: 'App\\Notifications\\NewEventFromOrganiser',
    newEventFromCategory: 'App\\Notifications\\NewEventFromCategory'
};

$(document).ready(function() {

    var markAllAsReadRoute = window.Laravel.organiserId
        ? $('#notificationsMenu').attr('data-markAllAsReadRoute')
        : $('.markAllNotificationsAsRead').attr('data-route');

    // check if there's a logged in user
    if(Laravel.organiserId) {

        $.get('/organiser/'+ Laravel.organiserId +'/notifications', function (data) {
            addNotifications(data, "#notifications");
        })
        .done(function(data){
            if(data.length > 0){
                $('#notificationsMenu').append("<li id='mark-all-as-read'><a>Mark All As Read</a></li>");
            }
        });
        setInterval( get_organiser_notifications, 10000 );
    } else if (Laravel.clientId){

        $.get('/client/notifications', function (data) {
            addNotifications(data, "#notifications");
        })
        .done(function(data){
                if(data.length > 0){
                    $('#notificationsMenu').append("<li id='mark-all-as-read'><a>Mark All As Read</a></li>");
                }
            });
        setInterval( get_client_notifications, 10000 );
    }

    $('#notifications').on('click', function(){
        if($(this).hasClass('has-notifications')) {
            $(this).removeClass('has-notifications');
        }
        $('.divider:last-of-type').remove();
    });

    $(document).on('click', '#mark-all-as-read',  function(){
        $.get(markAllAsReadRoute)
            .done(function(data){
                $('#notificationsMenu').html('<li class="dropdown-header">No notifications</li>');
        });
    });

});

function get_organiser_notifications(){
    $.get('/organiser/'+ Laravel.organiserId +'/notifications', function (data) {
        if(data.length > 0){
            data.forEach(function(notification){
                if(! $(`#${notification.id}`).length){
                    addNotifications([notification], "#notifications");
                }
            });
            if(! $('#mark-all-as-read').length){
                $('#notificationsMenu').append("<li id='mark-all-as-read'><a>Mark All As Read</a></li>");
            }
        }
    });
}

function get_client_notifications(){
    $.get('/client/notifications', function (data) {
        if(data.length > 0){
            data.forEach(function(notification){
                if(! $(`#${notification.id}`).length){
                    addNotifications([notification], "#notifications");
                }
            });
            if(! $('#mark-all-as-read').length){
                $('#notificationsMenu').append("<li id='mark-all-as-read'><a>Mark All As Read</a></li>");
            }
        }
    });
}

function addNotifications(newNotifications, target) {
    notifications = _.concat(notifications, newNotifications);
    // show only last 5 notifications
    notifications.slice(0, 5);
    showNotifications(notifications, target);
}

function showNotifications(notifications, target) {
    if(notifications.length) {
        var htmlElements = notifications.map(function (notification) {
            return makeNotification(notification);
        });
        $(target + 'Menu').html(htmlElements.join(''));
        $(target).addClass('has-notifications')
    } else {
        $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
        $(target).removeClass('has-notifications');
    }
}

function makeNotification(notification) {
    var to = routeNotification(notification);
    var notificationText = makeNotificationText(notification);
    return '<li class="notification-item" id="'+ notification.id +'"><a target="_blank" href="' + to + '">' + notificationText + '</a></li><li class="divider"></li>';
}

// get the notification route based on it's type
function routeNotification(notification) {
    var to = '&read=' + notification.id;
    if(notification.type === NOTIFICATION_TYPES.follow) {
        const profile_url = notification.data.follower_profile;
        to = profile_url + '?organiser_id='+ Laravel.organiserId  + to;
    } else if(notification.type === NOTIFICATION_TYPES.newEventFromOrganiser) {
        const event_url = notification.data.event_url;
        to = event_url + '?client_id=' + Laravel.clientId + '&ntf_org=1' + to;
    } else if(notification.type === NOTIFICATION_TYPES.newEventFromCategory) {
        const event_url = notification.data.event_url;
        to = event_url + '?client_id=' + Laravel.clientId + '&ntf_cat=1' + to;
    }

    return to;
}

// get the notification text based on it's type
function makeNotificationText(notification) {
    var text = '';
    if(notification.type === NOTIFICATION_TYPES.follow) {
        const name = notification.data.follower_name;
        const avatar = notification.data.follower_avatar;
        var avatarHTML = '<img class="img-circle" style="max-width:35px; margin-right: 8px;" src="'+ avatar +'" />';
        text += avatarHTML + '<strong>' + name + '</strong> followed you';

    } else if(notification.type === NOTIFICATION_TYPES.newEventFromOrganiser) {
        const name = notification.data.following_name;
        const avatar = notification.data.following_avatar;
        var avatarHTML = '<img class="img-circle" style="max-width:35px; margin-right: 8px;" src="'+ avatar +'" />';
        text += avatarHTML + `<strong>${name}</strong> published a new event`;

    } else if(notification.type === NOTIFICATION_TYPES.newEventFromCategory) {
        const name = notification.data.category_name;
        const avatar = notification.data.category_avatar;
        var avatarHTML = '<img class="img-circle" style="max-width:35px; margin-right: 8px;" src="'+ avatar +'" />';
        text += avatarHTML + `New event in <strong>${name}</strong>`;

    }

    return text;
}