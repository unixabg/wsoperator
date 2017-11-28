# WSOperator
Workstation phone home to switchboard operator for instructions.

## Pre-Install Requirements

* Be Safe & Secure

* Have a secured webserver which has php and .htaccess enabled for your target install.

## Install

1.) Clone this repository to your webserver (for example I will use /var/www/html/ as where you will install):

	cd /var/www/html
	git clone https://github.com/unixabg/wsoperator.git

2.) Change directory to the new wsoperator install:

	cd /var/www/html/wsoperator

3.) Setup username and passwords for .htaccess:

* Setup admin user(s) run the below (hint: you will be prompted for the user password).


	htpasswd -c .htpasswdadmin adminusername

After typing in the password you will have a new file called ".htpasswdadmin" with the new admin user information.

* If you want a manager user(s) you can also do:


	htpasswd -c .htpasswdmanager managerusername


After typing in the password you will have a new file called ".htpasswdmanager" with the new manager user information.

NOTE: After creating the first user in the .htpasswd files, you will no longer have to use the "-c".
