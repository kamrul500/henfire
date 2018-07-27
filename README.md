# henfire
a freelancer script like fiver or e-lance.

![alt text](https://raw.githubusercontent.com/Matthuffy/henfire/master/Extras%20/img/preview2.png)

# installation
First chmod 755 uploads folder
Then run the install.php and follow the on screen instructions. making sure that all tests are OK!

# extras
If your site is in English, then to save yourself time you may want to use the categories that I have already created which are in the Extras folder. Please be sure to edit the sql files first to match that of your prefix before you attempt to upload the extras to your database.

# Translating / languages
To add new languages you simply navigate to protected/common/messages in there you can copy the contents of en/ folder to a new folder which will be called the two letter name of the new language such as bg for Bulgarian, ca for Canadian etc..
Then edit the app.php and frontend.php accordingly.
You must then add the new lang to protected/common/config/main.php

Locate and add new lang:

'languages' => [ 'en', 'sr'],

# setting main language
protected/common/config/main.php and change from en at the top to your language that you created previously.

# added extra
It can also support PayPal pro although currently Disabled. using paypal pro will automate all payments and perform far better as an escrow without you having to manually do payments. However... manualy doing it may be much more secure!!!

# some pics
![alt text](https://raw.githubusercontent.com/Matthuffy/henfire/master/Extras%20/img/preview3.png)

![alt text](https://raw.githubusercontent.com/Matthuffy/henfire/master/Extras%20/img/preview4.png)
