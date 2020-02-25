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

### UserByEmailJoined
Triggered when a user join by email

### UserByNetworkJoined
Triggered when a user join by network

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

### UserPasswordResetted
Triggered when a user password reset

### UserPasswordChangingRequested
Triggered when a user password change requested

### UserRegisterConfirmed
Triggered when a user registration confirmed

### UserRoleChanged
Triggered when a user role changed

### UserRemoved
Triggered when a user removed