# Live Controls
 Controls/Scripts/Helpers for Laravel and Livewire
 Those are free to use, but are mostly for my own projects so no full support guaranteed.

## Admin System
A System providing an administration dashboard/interface to handle all the things here seperately

### Todo
- ?


## User Groups System
A System handling user groups and permissions based per ranks

### Content
- Usergroups table
- Middleware for routes to check if user is in group (usergroup:group_key)
- Middleware for routes to check if user is admin (admin). Admin group can be set in config and Master can be set as well
- Artisan commands to add group and add/remove user from group: livecontrols:addgroup, livecontrols:setgroup, livecontrols:unsetgroup


## User Permissions System
A System handling permissions for users or user groups, developer can add specific permissions by keyword and specific actions based on them which will show up afterwards

### Todo
- ?


## Captcha System
A System handling captchas (mostly Recaptcha, but can handle other systems as well)

### Todo
- Add Recaptcha v2
- Add Recaptcha v3


## Financial System
A System handling financial calculations and such

### Todo
- ?


## Payment System
A System handling different payment systems for e-commerce etc.

### Todo
- Add PagSeguro Handler
- Add Sicoob/Credsete Handler
- Add IUGU Handler


## Crypto
A System handling cryptography like encrypted database entries and such

### Todo
- Add encryptor/decryptor
- Add "EncryptedModel" which would transform encrypted database entries to normal models and viseversa


## Utils Systemes
A System with different utilities to make life easier, can be everything that doesn't fit into the other Systemes

### Todo
- ?