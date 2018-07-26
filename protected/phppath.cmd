@echo off

REM **************************************************************
REM * PLACE This file in a folder that is already on your PATH
REM * Or just put it in your C:\Windows folder as that is on the
REM * Serch path by default
REM * - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
REM * EDIT THE NEXT 3 Parameters to fit your installed WAMPServer
REM **************************************************************

REM The folder WAMPServer is installed in
set baseWamp=D:\wamp64
REM Pick a default version so you can call this without specifying
set defaultPHPver=7.1.9
REM Comment out if composer is not installed
set composerInstalled=%baseWamp%\composer
REM leave this alone
set phpFolder=\bin\php\php

if %1.==. (
    set phpver=%baseWamp%%phpFolder%%defaultPHPver%
) else (
    set phpver=%baseWamp%%phpFolder%%1
)

PATH=%PATH%;%phpver%
php -v
echo ---------------------------------------------------------------


REM IF PEAR IS INSTALLED IN THIS VERSION OF PHP

IF exist %phpver%\pear (
    set PHP_PEAR_SYSCONF_DIR=D:\wamp\bin\php\php%phpver%
    set PHP_PEAR_INSTALL_DIR=D:\wamp\bin\php\php%phpver%\pear
    set PHP_PEAR_DOC_DIR=D:\wamp\bin\php\php%phpver%\docs
    set PHP_PEAR_BIN_DIR=D:\wamp\bin\php\php%phpver%
    set PHP_PEAR_DATA_DIR=D:\wamp\bin\php\php%phpver%\data
    set PHP_PEAR_PHP_BIN=D:\wamp\bin\php\php%phpver%\php.exe
    set PHP_PEAR_TEST_DIR=D:\wamp\bin\php\php%phpver%\tests

    echo PEAR INCLUDED IN THIS CONFIG
    echo ---------------------------------------------------------------
) else (
    echo PEAR DOES NOT EXIST IN THIS VERSION OF php
    echo ---------------------------------------------------------------
)

REM IF A GLOBAL COMPOSER EXISTS ADD THAT TOO
REM **************************************************************
REM * IF A GLOBAL COMPOSER EXISTS ADD THAT TOO
REM * 
REM * This assumes that composer is installed in /wamp/composer
REM * 
REM **************************************************************
IF EXIST %composerInstalled% (
    ECHO COMPOSER INCLUDED IN THIS CONFIG
    echo ---------------------------------------------------------------
    set COMPOSER_HOME=%baseWamp%\composer
    set COMPOSER_CACHE_DIR=%baseWamp%\composer

    PATH=%PATH%;%baseWamp%\composer

    rem echo TO UPDATE COMPOSER do > composer self-update
    echo ---------------------------------------------------------------
) else (
    echo ---------------------------------------------------------------
    echo COMPOSER IS NOT INSTALLED
    echo ---------------------------------------------------------------
)

set baseWamp=
set defaultPHPver=
set composerInstalled=
set phpFolder=