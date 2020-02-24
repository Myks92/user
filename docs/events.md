# Event

Component events that you can subscribe.

## Basic example
You can attach a subscriber to each event from the list below.

#### Listener
```php
class UserCreatedListener
{
    // ...

    public function __invoke()
    {
        // ... do something
    }
}
```
#### Code
```php
$dispatcher = new SimpleEventDispatcher([
    UserCreated::class => [UserCreatedListener::class]
]);

$event = new UserCreated(...);
$dispatcher->dispatch($event);
```


## List events

### UserActivated
Triggered when a user activated

### UserBlocked
Triggered when a user blocked

### UserByEmailRegistered
Triggered when a user registered by email

### UserByNetworkRegistered
Triggered when a user by network registered

#### UserCreated
Triggered when a user created

### UserEdited
Triggered when a user edited

### UserEmailChanged
Triggered when a user email changed

### UserEmailChangingRequested
Triggered when a user email change request

### UserNameChanged
Triggered when a user name changed

### UserNetworkAttached
Triggered when a user network attached

### UserNetworkDetached
Triggered when a user network detached

### UserPasswordChanged
Triggered when a user password changed

### UserPasswordChangingRequested
Triggered when a user password change requested

### UserRegisterConfirmed
Triggered when a user registration confirmed

### UserRoleChanged
Triggered when a user role changed