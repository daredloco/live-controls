# Live Controls
 Controls/Scripts/Helpers for Laravel and Livewire
 Those are free to use, but are mostly for my own projects so no full support guaranteed.

 Check out the [Documentation](https://github.com/daredloco/live-controls/wiki/01.-Installation-&-Setup)
 
 **This library is not ready to be used in production!**

## Requirements
- Laravel 9+
- JetStream
- Livewire 2+
- Fortify
- [JetStrap](https://github.com/nascent-africa/jetstrap)



## Translations
- English (en)
- German (de)
- Brazilian Portuguese (pt_BR)



## Admin Interface
A System providing an administration dashboard/interface to handle all the things here seperately

[Documentation](https://github.com/daredloco/live-controls/wiki/02.-Admin-Interface)

### Content
- User Page where admins can add/edit/remove Users and give them Permissions
- User Group Page where admins can add/edit/remove Groups and give them Permissions
- Permissions Page where admins can add/edit/remove Permissions
- You can add custom livewire controls to the Admin Interface by adding them to the configuration file

### Todo
- Add custom Dashboard (Maybe someday...)
- ?




## User Groups System
A System handling user groups

[Documentation](https://github.com/daredloco/live-controls/wiki/03.-User-Groups)

### Content
- Usergroups per User
- Middleware for routes to check if user is in group (usergroup:group_key)
- Middleware for routes to check if user is admin (admin). Admin group can be set in config and Master can be set as well
- Artisan commands to add group and add/remove user from group: livecontrols:addgroup, livecontrols:setgroup, livecontrols:unsetgroup
- HasGroups trait for Users
- Colors can be asigned to User Groups




## User Permissions System
A System handling permissions for users or user groups, developer can add specific permissions by keyword and specific actions based on them which will show up afterwards

[Documentation](https://github.com/daredloco/live-controls/wiki/04.-User-Permissions)

### Content
- Userpermissions per User/UserGroup
- PermissionsHandler Facade to check if user has permissions
- Artisan commands to add Permissions and add/remove user/usergroups from permissions: livecontrols:addpermission, livecontrols:setpermission, livecontrols:unsetpermission
- HasPermissions trait for Users

### Todo
- Check if Subscription has expired inside the PermissionsHandler check




## Support Tickets System
A System handling support tickets where users can send tickets and admins/moderators have access to answer them

[Documentation](https://github.com/daredloco/live-controls/wiki/05.-Support-Tickets)

### Content
- Ticket Frontend for Users and Moderators. With route('livecontrols.support.index')
- SupportTickets with Title, Body, Priority and Status
- Configuration for "moderator" groups
- SupportTickets contain SupportMessages
- Moderators can change status of tickets
- Users can reopen tickets (sending messages will be disabled when ticket is closed)
- Configuration variable (support_reopen_tickets) if normal users can reopen ticket



## Financial System
A System handling financial calculations and such

[Documentation](https://github.com/daredloco/live-controls/wiki/06.-Financial)

### Content
- Fin class with useful functions (More functions will be added as time goes on)
- Cashflow object which handles financial cashflow (Includes CashflowItem class)

### Todo
- FGTS Calculator (Maybe someday)
- ?




## Payment System
A System handling different payment systems for e-commerce etc.

[Documentation](https://github.com/daredloco/live-controls/wiki/07.-Payment)

### Content
- PagSeguro (testing) Redirect Checkout
- PagSeguro Objects with important informations: PaymentItem, PaymentReceiver, PaymentSender, ShippingInformation
- IUGU Transparent Checkout
- IUGU has the option to create a payment per PIX, Bank Slip or Credit Card and you can update a bill and remove it if it isn't already paid or due
- IUGU Objects with important informations: PaymentItem, PaymentSender

### Todo
- Add IUGU Debit Card (If possible)
- Add PagSeguro Transparent Checkout (Depends on demand on projects)
- Add Sicoob/Credsete Handler (Depends on demand on projects)
- Take a look at Paymee and see if you can/want to include it
- Add PagSeguro production Redirect Checkout




## Crypto
A System handling cryptography like encrypted database entries and such

[Documentation](https://github.com/daredloco/live-controls/wiki/08.-Crypto)

### Content
- Added IsEncrypted trait with createEncrypted(array $fields, array $ignoredFields = []), updateEncrypted(array $fields, array $ignoredFields = []) and decrypt(string ...$fields)
- ~~EncryptedModel object based on model with create and update function.~~



## Subscriptions
A system for adding subscriptions for certain "products"/plugins/systems inside the system.

### Content
- Subscription System where users can subscribe to different subscriptions at once
- Config variables
- SubscriptionsHandler class to add/remove subscriptions from users, to check if subscription is valid and to check if user has a certain (valid) subscription
- Subscriptions inside Admin Interface
- Create/Edit/Delete Subscriptions in Admin Interface
- Middleware to check if user has subscription
- Subscriptions have permissions (Will fall into permissionscheck if active)

### Todo
- Add subscriptions to groups



## ToastR
Simple implementation of ToastR popups

**DO NOT USE TOASTR ANYMORE, REMOVED IN VERSION 0.4-dev AND ABOVE!**

Reason: https://github.com/CodeSeven/toastr/issues/689

[Documentation](https://github.com/daredloco/live-controls/wiki/09.-ToastR)

### Content
- ~~Blade Component <livecontrols::toastr> which can be called by livewire or javascript. Put it on the bottom of the body.~~




## SweetAlert2
Simple implementation of SweetAlert2 popups.

### Content
- Livewire Control (Blade Component didn't work). Add it to the body of your layout or the page you want to use it.
- Timer and (optional) progressbar to close the window automatically
- Added InputFields (Text, Numeric, Date, Time, Color, TextArea, Select, Radio, File) to Popups called by Livewire
- Added InputGroups which acts as a group of InputFields for easy implementation and creation

### Todo
- Add option to call popup with custom options (Add a constructor for custom popups like in lagoon charts library, maybe with an aditional array $options or such)
- Add inputfields to popups called from controller (Needs callback)
- Add more types of inputfields (Radio, Checkbox, ...)
- Add to show loading spinner
```
didOpen: () => {
Swal.showLoading()
}
```

[Documentation](https://github.com/daredloco/live-controls/wiki/10.-SweetAlert2)


## AutoCEP Input
An Input for CEP which would give you the informations for road, etc. based on CepAberto

### Content
- GetCEP class
- AutoCep input - @livewire('livecontrols-autocep')




## Masked Input
A masked input based on iMask

### Content
- Masked Input livewire control - @livewire('livecontrols-masked-input')




## BBEditor
A BBEditor based on SCEditor (Probably generate own library out of this)

### Content
- Simple BB Editor livewire control

### Todo
- Add placeholders like in private system, but more dynamic



## Calendar
A Calendar based on FullCalendar.io

### Content
- Livewire Control with @livewire('livecontrols-calendar')
- Added eventClick events
- Added different view options

### Todo
- Add custom options for time shown etc.
- Add more options
- Make design better on mobile devices



## Dynamic Pages
Pages with controls that can be dynamically added and positioned

### Todo
- Add base system



## User blocking/banning
Add a system to block users for a certain amount of time or ban them completely. This should be done not only by email, but by IP and other systems

### Content
- Simple banning system with username/email blocking

### Todo
- Add a blacklist of names
- Add blocking to Admin Interface


## Utils Systemes
A System with different utilities to make life easier, can be everything that doesn't fit into the other Systemes

[Documentation](https://github.com/daredloco/live-controls/wiki/11.-Utils)

### Content
- Utils class with various helpers
- Array class with various helpers
- BBCodes class with transform() method to transform bbcode to html

### Todo
- ?
