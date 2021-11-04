# PHP Goof - Snyk's vulnerable demo php app

A vulnerable PHP demo todo application that is for demonstration and education purposes only, i take no responsibility for this being used with malicious intent nor should this be used for malicious intent (or be run in any product environment).

## Requisites & Running 

- PHP 7.1+
- Mysql or MariaDB 
- Composer 2

Run composer install

Create mysql or mariaDB database and update the db.php file, with database details. 

Import database.sql file into the newly created database or run the following table create.

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

[snyk.io/vuln/SNYK-PHP-LEAGUECOMMONMARK-174004](https://snyk.io/vuln/SNYK-PHP-LEAGUECOMMONMARK-174004)

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

## Fixing the issues
To find these flaws in this application (and in your own apps), run:

```
npm install -g snyk
snyk wizard
```

In this application, the default snyk wizard answers will fix all the issues. When the wizard is done, restart the application and run the exploits again to confirm they are fixed.