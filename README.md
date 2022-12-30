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




## Admin Interface
A System providing an administration dashboard/interface to handle all the things here seperately

[Documentation](https://github.com/daredloco/live-controls/wiki/02.-Admin-Interface)

### Content
- User Page where admins can add/edit/remove Users and give them Permissions
- User Group Page where admins can add/edit/remove Groups and give them Permissions
- Permissions Page where admins can add/edit/remove Permissions
- You can add custom livewire controls to the Admin Interface by adding them to the configuration file

### Todo
- Add custom Dashboard - Users will be able to select which controls they want to see on the dashboard
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



## Support Tickets System
A System handling support tickets where users can send tickets and admins/moderators have access to answer them

[Documentation](https://github.com/daredloco/live-controls/wiki/05.-Support-Tickets)

### Content
- Ticket Frontend for Users and Moderators. With route('livecontrols.support.index')
- SupportTickets with Title, Body, Priority and Status
- Configuration for "moderator" groups
- SupportTickets contain SupportMessages

### Todo
- Let moderators change the status of the tickets
- If a ticket is closed, disable the function to send SupportMessages
- Let users and moderators reopen a support ticket




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

[Documentation](https://github.com/daredloco/live-controls/wiki/08.-Crypto)

### Content
- Added IsEncrypted trait with createEncrypted(array $fields, array $ignoredFields = []), updateEncrypted(array $fields, array $ignoredFields = []) and decrypt(string ...$fields)
- ~~EncryptedModel object based on model with create and update function.~~



## Subscriptions
A system for adding subscriptions like plans etc. (Probably will be a seperate library as it's not used in many projects)

### Todo
- Add a system to create subscription plans with name, description, value and default values




## ToastR
Simple implementation of ToastR popups

**DO NOT USE TOASTR ANYMORE, WILL BE REMOVED IN VERSION 0.4-dev AND ABOVE!**

Reason: https://github.com/CodeSeven/toastr/issues/689

[Documentation](https://github.com/daredloco/live-controls/wiki/09.-ToastR)

### Content
- Blade Component <livecontrols::toastr> which can be called by livewire or javascript. Put it on the bottom of the body.




## SweetAlert2
Simple implementation of SweetAlert2 popups.

### Content
- Livewire Control (Blade Component didn't work). Add it to the body of your layout or the page you want to use it.
- Added InputTypes: TextInput, NumericInput
- Timer and (optional) progressbar to close the window automatically
- Added InputFields (Text, Numeric, Date, Time, Color, TextArea, Select) to Popups called by Livewire
- Added InputGroups which acts as a group of InputFields for easy implementation and creation

### Todo
- Add option to call popup with custom options (Add a constructor for custom popups like in lagoon charts library, maybe with an aditional array $options or such)
- Add inputfields to popups called from controller
- Add more types of inputfields (Radio, Checkbox, ...)
- Add button as "Inputfield"
- Add to show loading spinner
```
didOpen: () => {
Swal.showLoading()
}
```

[Documentation](https://github.com/daredloco/live-controls/wiki/10.-SweetAlert2)




## Utils Systemes
A System with different utilities to make life easier, can be everything that doesn't fit into the other Systemes

[Documentation](https://github.com/daredloco/live-controls/wiki/11.-Utils)

### Todo
- ?