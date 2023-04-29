<?php

return [
    //External Routes
    'routes_users' => ['create' => '', 'edit' => '', 'delete' => ''], //Set the routes where you create, edit or delete Users

    //Route Middlewares
    'routes_middlewares' => [], //The middlewares that should be added to the routes

    //Admin Interface
    'admininterface_enabled' => true, //Set this to true if you want to enable the admin interface
    'admininterface_master' => 1, //Set this to the user id you want to give master access
    'admininterface_prefix' => 'admin', //The prefix used for the Route::group
    'admininterface_customcontrols' => [], //Add custom livewire controls here (ex. 'Statistics' => 'admin.stats')

    //User groups
    'usergroups_enabled' => true, //Set this to true if usergroups should be enabled
    'usergroups_admins' => ['admin'], //The keys of the usergroups with root access

    //User permissions
    'userpermissions_enabled' => true, //Set this to true if userpermissions should be enabled

    //Payment System
    'payments_backends' => ['pagseguro'], //Set the payment backends here. Supported are 'pagseguro', 'iugu'

    //Support System
    'support_enabled' => true, //Set this to true to enable the support system
    'support_groups' => ['moderators'], //Set the support groups here. (ex. ['moderators']), admins will be automatically set!
    'support_prefix' => 'support', //The prefix used for the Route::group
    'support_reopen_ticket' => true, //Set this to true to enable users being able to reopen tickets

    //Subscriptions System
    'subscriptions_enabled' => true, //Set this to true to enable the subscription system
    'subscriptions_default_days' => 365, //Set this to the default days a subscription will be valid
    'subscriptions_payment_delay_days' => 30, //Set this to the amount of days you'd let the user use the system without renew the plan
    'subscriptions_multiple_per_user' => true, //If set to true, users can have multiple subscriptions
    'subscriptions_due_route' => null, //Set the route that will be shown if the subscription is due (Renew subscription for example)

    //Banning System
    'banning_enabled' => true, //Set this to true to enable the banning system

    //Analytics System
    'analytics_enabled' => false, //Set this to true to enable the analytics system
    'analytics_cookie' => false, //Set this to true if you want to send an analytics cookie
    'analytics_user' => false, //Set this to true to save the user with the Request
    'analytics_identifier'=> 'ip_hash', //Set what should be used as identifier. Default is ip_hash. Possible values ip_hash, full_ip
    'analytics_geoapi' => null, //Set the geo API used. There aren't any included at the moment!
    'analytics_query_key' => 'lcid', //This would be the querystring key to identify a special campaign etc.
    'analytics_campaigns_enabled' => true, //Set this to true to enable analytics campaigns
    'analytics_actions_enabled' => true, //Set this to true to enable analytics actions
    'analytics_charts_enabled' => false, //Set this to true to enable charts, charts will need helvetiapps/lagoon-charts to work! Needs headerScripts and styles stacks in app layout!

    //Images System
    'images_enabled' => true, //Set this to true to enable images upload
    'images_disk' => 'public', //Set this to the disk that should be used for public images
    'images_disk_private' => 'private', //Set this to the disk that should be used for private images
    'images_permissions_enabled' => true, //Set this to true to enable UserPermissions for image upload/show/delete
    'images_permission_upload' => null, //Set this to a string representing the UserPermission needed to upload images or to null to enable it for everyone
    'images_permission_show' => null, //Set this to a string representing the UserPermission needed to show images or to null to enable it for everyone
    'images_permission_delete' => null, //Set this to a string representing the UserPermission needed to delete images or to null to enable it for admins/user
    'images_galery_enabled' => true, //Set this to true to enable the image galery
    'images_thumbnails_enabled' => true, //Set this to false and every image will be returned as full size image
    'images_thumbnails_runtime' => false, //Set this to true if you want to generate thumbnails on runtime for whatever reason
    'images_thumbnail_size' => [100,100], //Set this to the dimensions you want your thumbnails to be shown
];