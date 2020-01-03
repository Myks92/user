#Use

## Activate

```php
use Myks92\User\Model\User\UseCase\Activate;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Activate\Handler($users, $flusher);
$command = new Activate\Command($userId);

$handler->handle($command);
```

## Block

```php
use Myks92\User\Model\User\UseCase\Block;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Block\Handler($users, $flusher);
$command = new Block\Command($userId);

$handler->handle($command);
```

## Edit

```php
use Myks92\User\Model\User\UseCase\Edit;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Edit\Handler($users, $flusher);

$command = new Edit\Command($userId);
$command->email = 'email@app.ru';
$command->firstName = 'First Name';
$command->lastName = 'Last Name';

$handler->handle($command);
```

## Request email

```php
use Myks92\User\Model\User\UseCase\Email\Request;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Request\Handler($users, $tokenizer, $sender, $flusher);
$command = new Request\Command($userId);

$handler->handle($command);
```

## Confirm email

```php
use Myks92\User\Model\User\UseCase\Email\Confirm;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Confirm\Handler($users, $flusher);
$command = new Confirm\Command($userId, 'token');

$handler->handle($command);
```

## Change name

```php
use Myks92\User\Model\User\UseCase\Name;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Name\Handler($users, $flusher);
$command = new Name\Command($userId);
$command->first = 'First';
$command->last = 'Last';

$handler->handle($command);
```

## Attach network

```php
use Myks92\User\Model\User\UseCase\Network\Attach;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Attach\Handler($users,$flusher))
$command = new Attach\Command($userId, 'vk', 'id1');

$handler->handle($command);
```

## Detach network

```php
use Myks92\User\Model\User\UseCase\Network\Detach;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Detach\Handler($users,$flusher))
$command = new Detach\Command($userId, 'vk', 'id1');

$handler->handle($command);
```

## Request password by email

```php
use Myks92\User\Model\User\UseCase\Reset\Request;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Request\Handler($users,$tokenizer,$flusher,$sender);
$command = new Request\Command($userId, 'vk', 'id1');

$handler->handle($command);
```

## Reset password

```php
use Myks92\User\Model\User\UseCase\Reset\Reset;

$handler = new Reset\Handler($users,$hasher,$flusher);
$command = new Reset\Command('token');

$handler->handle($command);
```

## Change role

```php
use Myks92\User\Model\User\UseCase\Role;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Role\Handler($users,$flusher);
$command = new Role\Command($userId);

$handler->handle($command);
```

## Sign up by email

```php
use Myks92\User\Model\User\UseCase\SignUp\Request;

$handler = new Request\Handler($users,$hasher,$tokenizer,$sender,$flusher);

$command = new Request\Command();
$command->firstName = 'First Name';
$command->lastName = 'Last Name';
$command->email = 'email@app.ru';
$command->password = 'password';

$handler->handle($command);
```

## Sign up by network

```php
use Myks92\User\Model\User\UseCase\Network\Auth;

$handler = new Auth\Handler($users,$flusher);

$command = new Auth\Command('vk', 'id1');
$command->firstName = 'First Name';
$command->lastName = 'Last Name';

$handler->handle($command);
```

## Confirm sign up by token

```php
use Myks92\User\Model\User\UseCase\SignUp\Confirm\ByToken;

$handler = new ByToken\Handler($users,$flusher);

$command = new ByToken\Command('token');

$handler->handle($command);
```

## Confirm sign up manual

```php
use Myks92\User\Model\User\UseCase\SignUp\Confirm\Manual;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Manual\Handler($users,$flusher);

$command = new Manual\Command($userId);

$handler->handle($command);
```