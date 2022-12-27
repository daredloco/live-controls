<?php

return [
    //Admin Interface
    'admininterface_enabled' => true, //Set this to true if you want to enable the admin interface
    'admininterface_master' => 1, //Set this to the user id you want to give master access
    'admininterface_prefix' => 'admin', //The prefix used for the Route::group
    
    //User groups
    'usergroups_enabled' => true, //Set this to true if usergroups should be enabled
    'usergroups_admins' => ['admin'], //The keys of the usergroups with root access

    //User permissions
    'userpermissions_enabled' => true, //Set this to true if userpermissions should be enabled

    //Payment System
    'payments_enabled' => true, //Set this to true if payments should be enabled
    'payments_backends' => ['pagseguro'], //Set the payment backends here. Supported are 'pagseguro', 'iugu'
];