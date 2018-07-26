# henfire
a free freelancer script like fiver or e-lance.

![alt text](https://raw.githubusercontent.com/Matthuffy/henfire/master/Extras%20/img/preview2.png)


# demo
I will get a new demo site up soon as my hosting ran out while I was away and it did not auto renew.
If you install this and would like me to link to yours I will gladly do so here.

# installation
First chmod 755 uploads folder
Then run the install.php and follow the on screen instructions. making sure that all tests are OK!

# extras
If your site is in English, then to save yourself tie you may want to use the categories that I have already created which are in the Extras folder. Please be sure to edit the sql files first to match that of your prefix before you attempt to upload the extras to your database.

# Translating / languages
To add new languages you simply navigate to protected/common/messages in there you can copy the contents of en/ folder to a new folder which will be called the two letter name of the new language such as bg for bulgarian, ca for canadian etc..
Then edit the app.php and frontend.php accordingly.
You must then add the new lng to the protected/common/config/main.php.

Locate
'languages' => [ 'en', 'sr'],

# setting main language
protected/common/config/main.php and change from en at the top to your language that you created previously.

# some pics
[alt text](https://raw.githubusercontent.com/Matthuffy/henfire/master/Extras%20/img/preview3.png)
[alt text](https://raw.githubusercontent.com/Matthuffy/henfire/master/Extras%20/img/preview4.png)
