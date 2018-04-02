
window._ = require('lodash');

//import Echo from "laravel-echo";
//window.Pusher = require('pusher-js');
//window.Echo = new Echo({
//    broadcaster: 'pusher',
//    key: '9d1c81efe142ffcf493b',
//    cluster: 'us2',
//    encrypted: true
//});
//Pusher.log = function(message){
//    window.console.log(message)
//};

var notifications = [];

const NOTIFICATION_TYPES = {
    follow: 'App\\Notifications\\OrganiserFollowed',
    newEventFromOrganiser: 'App\\Notifications\\NewEventFromOrganiser',
    newEventFromCategory: 'App\\Notifications\\NewEventFromCategory'
};


$(document).ready(function() {
    // check if there's a logged in user
    if(Laravel.organiserId) {

        $.get('/organiser/'+ Laravel.organiserId +'/notifications', function (data) {
            addNotifications(data, "#notifications");
        });

        //setInterval( get_organiser_notifications, 5000 );


    } else if (Laravel.clientId){
        $.get('/client/notifications', function (data) {
            addNotifications(data, "#notifications");
        });

    }
});

function get_organiser_notifications(){
    //console.log('called');

    $.get('/organiser/'+ Laravel.organiserId +'/notifications', function (data) {
        //console.log(data.length > 0);
        if(data.length > 0){
            data.forEach(function(notification){
                if($(`#${notification.id}`).length){
                    console.log('already exists');
                } else {
                    addNotifications(data, "#notifications");
                }
            });

        }


    });
}

function get_client_notifications(){
    //$.get(route, function (data) {
    //    addNotifications(data, "#notifications");
    //});
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
    return '<li id="'+ notification.id +'"><a target="_blank" href="' + to + '">' + notificationText + '</a></li><li class="divider"></li>';
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