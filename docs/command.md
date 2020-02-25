# Command

## Activate

```php
use Myks92\User\Model\User\Command\Activate;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Activate\Handler($users, $flusher);
$command = new Activate\Command($userId);

$handler->handle($command);
```

## Block

```php
use Myks92\User\Model\User\Command\Block;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Block\Handler($users, $flusher);
$command = new Block\Command($userId);

$handler->handle($command);
```

## Edit

```php
use Myks92\User\Model\User\Command\Edit;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Edit\Handler($users, $flusher);

$command = new Edit\Command($userId);
$command->email = 'email@app.ru';
$command->firstName = 'First Name';
$command->lastName = 'Last Name';

$handler->handle($command);
```

## Request Change Email

```php
use Myks92\User\Model\User\Command\ChangeEmail\Request;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Request\Handler($users, $tokenizer, $sender, $flusher);
$command = new Request\Command($userId);

$handler->handle($command);
```

## Confirm Change Email

```php
use Myks92\User\Model\User\Command\ChangeEmail\Confirm;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Confirm\Handler($users, $flusher);
$command = new Confirm\Command($userId, 'token');

$handler->handle($command);
```

## Change Change Name

```php
use Myks92\User\Model\User\Command\ChangeName;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new ChangeName\Handler($users, $flusher);
$command = new ChangeName\Command($userId);
$command->first = 'First';
$command->last = 'Last';

$handler->handle($command);
```

## Attach Network

```php
use Myks92\User\Model\User\Command\AttachNetwork;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new AttachNetwork\Handler($users,$flusher))
$command = new AttachNetwork\Command($userId, 'vk', 'id1');

$handler->handle($command);
```

## Detach Network

```php
use Myks92\User\Model\User\Command\DetachNetwork;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new DetachNetwork\Handler($users,$flusher))
$command = new DetachNetwork\Command($userId, 'vk', 'id1');

$handler->handle($command);
```

## Request Reset Password

```php
use Myks92\User\Model\User\Command\ResetPassword\Request;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Request\Handler($users,$tokenizer,$flusher,$sender);
$command = new Request\Command($userId, 'vk', 'id1');

$handler->handle($command);
```

## Confirm Reset Password

```php
use Myks92\User\Model\User\Command\ResetPassword\Confirm;

$handler = new Confirm\Handler($users,$hasher,$flusher);
$command = new Confirm\Command('token');

$handler->handle($command);
```

## Change Role

```php
use Myks92\User\Model\User\Command\ChangeRole;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new ChangeRole\Handler($users,$flusher);
$command = new ChangeRole\Command($userId);

$handler->handle($command);
```

## Join By Network

```php
use Myks92\User\Model\User\Command\JoinByNetwork;

$handler = new JoinByNetwork\Handler($users,$flusher);

$command = new JoinByNetwork\Command('vk', 'id1');
$command->firstName = 'First Name';
$command->lastName = 'Last Name';

$handler->handle($command);
```

## Request Join By Email

```php
use Myks92\User\Model\User\Command\JoinByEmail\Request;

$handler = new Request\Handler($users,$hasher,$tokenizer,$sender,$flusher);

$command = new Request\Command();
$command->firstName = 'First Name';
$command->lastName = 'Last Name';
$command->email = 'email@app.ru';
$command->password = 'password';

$handler->handle($command);
```

## Confirm Join By Email By Token

```php
use Myks92\User\Model\User\Command\JoinByEmail\Confirm\ByToken;

$handler = new ByToken\Handler($users,$flusher);

$command = new ByToken\Command('token');

$handler->handle($command);
```

## Confirm Join By Email By Manual

```php
use Myks92\User\Model\User\Command\JoinByEmail\Confirm\ByManual;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new ByManual\Handler($users,$flusher);

$command = new ByManual\Command($userId);

$handler->handle($command);
```

## Removed

```php
use Myks92\User\Model\User\Command\Remove;

$userId = '00000000-0000-0000-0000-000000000001'; //UUID

$handler = new Remove\Handler($users,$flusher);

$command = new Remove\Command($userId);

$handler->handle($command);
```