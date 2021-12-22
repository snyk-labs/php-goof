# PHP Goof - Snyk's vulnerable demo php app

A vulnerable PHP demo todo application that is for demonstration and education purposes only, i take no responsibility for this being used with malicious intent nor should this be used for malicious intent (or be run in any product environment).

## Requisites & Running 

- PHP 7.1+
- Mysql or MariaDB 
- Composer 2

Run composer install from the project root directory

Create mysql or mariaDB database and update the db.php file, with database details. 

Import sql/database.sql file into the newly created database or run the following table create.

```
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb3;
```

Finally, Using the PHP built in server run the code from the root app directory

```
php -S localhost:8000
```

## Exploiting the vulnerabilities

### Commonmark XSS Vulnerability

[SNYK-PHP-LEAGUECOMMONMARK-174004](https://security.snyk.io/vuln/SNYK-PHP-LEAGUECOMMONMARK-174004)

```
* Markdown link
This is **markdown**

* Markdown link
[Snyk](https://snyk.io/)

* Failed XSS
[Gotcha](javascript:alert(1))

* Failed XSS despite URL encoding
[Gotcha](javascript&#58;alert(1&#41;)

* Successfull XSS using vuln and browser interpretation 
[Gotcha](javascript&amp;colon;alert%28&#039;Gotcha&#039;%29)
```

### PHPMailer 

[SNYK-PHP-PHPMAILERPHPMAILER-1311001](https://security.snyk.io/vuln/SNYK-PHP-PHPMAILERPHPMAILER-1311001)

Uses the `validateAddress()` exploit from PHPMailer 6.4.1 to execute the global `PHP()` function by default. If no argument is passed into the `validateAddress()` function, which isnt in this demo, PHPMailer sets "PHP" as the default value and runs it if its available in the scope. 

To run click the email icon next to a line entry to send an email reminder. 

Note: No emails will actually send or are being stored, only validating the email address entered into the input using the PHPMailer library. 

## Fixing the issues
To find these flaws in this application (and in your own apps), run:
```
npm install -g snyk
snyk wizard
```

In this application, the default `snyk wizard` answers will fix all the issues.
When the wizard is done, restart the application and run the exploits again to confirm they are fixed.

