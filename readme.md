# PHP Goof - Snyk's vulnerable demo php app

A vulnerable PHP demo application

## Requisites & Running 

- PHP 7.1+
- Mysql or MariaDB 
- Composer 2

Using the PHP built in server run the code from the root app directory

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