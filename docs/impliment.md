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
