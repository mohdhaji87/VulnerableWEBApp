-----------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------

forked from mohdhaji87/VulnerableWEBApp

modified some stuff

to run:
Install webserver (e.g. nginx), install php, enable php in nginx, install mysql,
enable mysql in php, create mysql user 'test:test', create database 'project' in mysql, create table 'user' in database
'project' with columns 'user_id, username, password and email' as shown below.
Reload webserver and visit webapp.


------------------ MYSQL steps ------------------

CREATE DATABASE project;
CREATE TABLE user (
    user_id int NOT NULL AUTO_INCREMENT,
    username TEXT,
    password TEXT,
    email TEXT,
    PRIMARY KEY (user_id)
);




-----------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------

# VulnerableWEBApp
Coded a sample vulnerable web application for learning purpose..

It has following vulnerabilities which can be exploited

--> SQLI (Select , Update , Insert, Delete)
[select SQLI in login bypass]
[Insert SQLI in Register process]
[Update SQLI in profile update , changing password]
[Delete SQLI in Deleting account]
[Blind SQLI in forgot password]

--> Clickjacking (Framebursting technique, X-frame options missing)
[Framebursting is used in all the pages which can be exploited using sandbox="allow-forms" ]
[X-frame options missing in all pages]

-->Insecure Direct Object reference
[Account deletion ]
[Password change]
[Password reset]


-->Command Injection
[ping functionality vulnerable to command injection using | we can concatenate commands]

-->CSRF
[ csrf token missing]
[while profile update]


-->XSS
[No user input enconding/sanitizaion . output also without encoding/sanitization which is vulnerable to xss ]
[While registering]
[At setting page]


-->Local File Inclusion (LFI) :
(While including TOS file)
