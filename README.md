# Push-Notification
Last update: September-2015

Using Push Notification in iOS Apps

This repository is for setting up Push Notification (iOS and Android Apps)

iOS
-----------------------------------------------
AppDelegate.swift
  - iOS app initialization
Push.php and Push-PHP-Example.php
  - Server (PHP) function to push notification.
  - PHP Test example (note: please use different APNS connection URL for DEV and PROD environment)
  - Require Cert-Key.pem (combining Cert.pem and Key.pem)
    (e.g. using command: $ cat Cert.pem Key.pem > cert-key.pem)
iOS-PushNotification-Ref.js
  - Node.js version of Push.php
  - Require Cert.pem and Key.pem

Android
-----------------------------------------------
PushAndroid.js
 - Server side code template to push a message to a device.
 - Node.js version
