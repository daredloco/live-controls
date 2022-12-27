# Live Controls
 Controls/Scripts/Helpers for Laravel and Livewire
 Those are free to use, but are mostly for my own projects so no full support guaranteed.

 **This library is not ready to be used in production!**

## Requirements
- Laravel 9+
- JetStream
- Livewire 2+
- Fortify
- [JetStrap](https://github.com/nascent-africa/jetstrap)
- stack('styles') in the <head> of the layout (If using ToastR)




## Admin System
A System providing an administration dashboard/interface to handle all the things here seperately

### Content
- You can add custom livewire controls to the Admin Interface by adding them to the configuration file

### Todo
- Add custom Dashboard - Users will be able to select which controls they want to see on the dashboard
- Add Permissions page - Admins will be able to add/edit/remove Permissions
- Add Users page - Admins will be able to add/edit/remove Users and change their permissions
- Add User Groups page - Admins will be able to add/edit/remove User Groups and change their permissions
- ?




## User Groups System
A System handling user groups

### Content
- Usergroups per User
- Middleware for routes to check if user is in group (usergroup:group_key)
- Middleware for routes to check if user is admin (admin). Admin group can be set in config and Master can be set as well
- Artisan commands to add group and add/remove user from group: livecontrols:addgroup, livecontrols:setgroup, livecontrols:unsetgroup
- HasGroups trait for Users
- Colors can be asigned to User Groups




## User Permissions System
A System handling permissions for users or user groups, developer can add specific permissions by keyword and specific actions based on them which will show up afterwards

### Content
- Userpermissions per User/UserGroup
- PermissionsHandler Facade to check if user has permissions
- Artisan commands to add Permissions and add/remove user/usergroups from permissions: livecontrols:addpermission, livecontrols:setpermission, livecontrols:unsetpermission




## Support Tickets System
A System handling support tickets where users can send tickets and admins/moderators have access to answer them

### Todo
- Add ticket frontend with type (can be added by admins), title, description and fileupload (if allowed in config)
- Add frontend for admins/moderators to answer tickets and change their status
- Add moderators as group in config




## Financial System
A System handling financial calculations and such

### Content
- Fin class with useful functions (More functions will be added as time goes on)
- Cashflow object which handles financial cashflow (Includes CashflowItem class)

### Todo
- FGTS Calculator (Maybe someday)
- ?




## Payment System
A System handling different payment systems for e-commerce etc.

### Content
- PagSeguro Redirect Checkout
- PagSeguro Objects with important informations: PaymentItem, PaymentReceiver, PaymentSender, ShippingInformation
- IUGU Transparent Checkout
- IUGU has the option to create a payment per PIX, Bank Slip or Credit Card and you can update a bill and remove it if it isn't already paid or due
- IUGU Objects with important informations: PaymentItem, PaymentSender

### Todo
- Add IUGU Debit Card (If possible)
- Add PagSeguro Transparent Checkout (Depends on demand on projects)
- Add Sicoob/Credsete Handler (Depends on demand on projects)




## Crypto
A System handling cryptography like encrypted database entries and such

### Content
- Added IsEncrypted trait with createEncrypted(array $fields, array $ignoredFields = []), updateEncrypted(array $fields, array $ignoredFields = []) and decrypt(string ...$fields)




## Subscriptions
A system for adding subscriptions like plans etc. (Probably will be a seperate library as it's not used in many projects)

### Todo
- Add a system to create subscription plans with name, description, value and default values




## ToastR
Simple implementation of ToastR popups

### Content
- Blade Component <livecontrols::toastr> which can be called by livewire or javascript. Put it on the bottom of the body.




## Utils Systemes
A System with different utilities to make life easier, can be everything that doesn't fit into the other Systemes

### Todo
- ?