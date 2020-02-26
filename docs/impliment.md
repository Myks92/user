# Implement required interfaces

Implement all required interfaces library

## Event Dispatcher example
[PSR-14](https://www.php-fig.org/psr/psr-14/) compatible event dispatcher provides an ability to dispatch events and listen to events dispatched.

```php
use Psr\EventDispatcher\EventDispatcherInterface;

class SimpleEventDispatcher implements EventDispatcherInterface
{
    private array $listeners;

    public function __construct(array $listeners)
    {
        $this->listeners = $listeners;
    }

    public function dispatch($event): void
    {
        $eventName = get_class($event);
        if (array_key_exists($eventName, $this->listeners)) {
            foreach ($this->listeners[$eventName] as $listenerClass) {
                $listenerClass($event);
            }
        }
    }
}
```
#### Event dispatcher for frameworks:

- [Symfony](https://github.com/symfony/event-dispatcher)
- [Yii2](https://github.com/yiisoft/event-dispatcher)

## Join confirm token sender

```php
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Token;
use Myks92\User\Model\User\Service\JoinConfirmTokenSenderInterface;

class JoinConfirmTokenSender implements JoinConfirmTokenSenderInterface
{
    /**
     * @param Email $email
     * @param Token $token
     */
    public function send(Email $email, Token $token): void 
    {
        // Send email with confirm token for join
    }
}
```

## Password reset token sender

```php
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Token;
use Myks92\User\Model\User\Service\PasswordResetTokenSenderInterface;

class PasswordResetTokenSender implements PasswordResetTokenSenderInterface
{
    /**
     * @param Email $email
     * @param Token $token
     */
    public function send(Email $email, Token $token): void 
    {
        // Send email with reset token
    }
}
```

## New email confirm token sender

```php
use Myks92\User\Model\User\Entity\User\Email;
use Myks92\User\Model\User\Entity\User\Token;
use Myks92\User\Model\User\Service\NewEmailConfirmTokenSenderInterface;

class NewEmailConfirmTokenSender implements NewEmailConfirmTokenSenderInterface
{
    /**
     * @param Email $email
     * @param Token $token
     */
    public function send(Email $email, Token $token): void 
    {
        // Send email with confirm token for change email
    }
}
```