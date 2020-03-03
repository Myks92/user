## 2.0.0 (2020-03-03)

* Required email at joined
* Extracted user repository to command remove
* Removed command confirm by manual
* Added validations for email
* Updated check for email
* Fixed type error for doctrine
* Added post load for doctrine mapping
* Added getter status
* Fixed bug doctrine annotations
* Updated `composer.json`
* Fixed documentation
* Added documentations for implement token
* Refactor user repository
* Fixed user validate command
* Added user remove command
* Updated `symfony/validator to ^5.0`
* Merge remote-tracking branch 'github/master'
* Edited `.travis.yml`
* Merge remote-tracking branch 'github/master'
* Edited `.travis.yml`
* Edited `.travis.yml`
* Added `.travis.yml` command `composer self-update`
* Changed unstable version to `2.0`
* Added name testing entity
* Added network testing entity
* Renamed test class form `ResetTest.php` to `ConfirmTest.php`
* Fixed testing change email
* Updated minimum version for phpunit
* Renamed method from `resetPassword` to `confirmPasswordReset`
* Refactoring Command
* Renamed `Use Case` to `Command`
* Added event testing
* Edited user methods
* Added edit testing
* Added create testing
* Added getters for events
* Added token testing
* Added name testing
* Added role testing
* Renamed from `"sign up"` to `"join"`
* Refactored testing
* Added email testing
* Added status testing
* Fixed confirm to sign up
* Renamed `ResetTokenSenderInterface.php` to `PasswordResetTokenSenderInterface.php`
* Renamed reset token in `User.php`
* Renamed error in handler reset password
* Renamed event `UserPasswordChanged.php` to `UserPasswordResetted.php`
* Added `TokenizerTest.php`
* Renamed method in `Id.php` from `"next"` to `"generate"`
* Refactoring status
* Refactoring token
* Changed algorithm `PasswordHasher.php` to Argon2id
* PHP `7.4` #4

## 1.2.1 (2020-02-24)

* Add documentation on the use of events

## 1.2.0 (2020-02-22)

* Extract interfaces for Flusher.php and PasswordGenerator.php, refactor
* Update dependencies
* Add support php 7.4 in .travis.yml

## 1.1.1 (2020-02-19)

* Add composer.lock
* Refactor test

## 1.1.0 (2020-02-19)

* Add subscribers events 
* Refactor: optimize imports, reformat, rearrange cleanup
* Change EventDispatcher to PSR-12
* Edit .gitignore

## 1.0.0 (2019-01-03)

* Initial release of the new component