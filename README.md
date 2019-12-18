# Restaurare Web-Mobile Fast tool to Application Development


This component is a new way to rapid develop web-mobile applications, almost anyone can create a mobile web app in less then 10 minutes using the most recent technologies like web-components.

The concept behind this component, is that the developer doesn't need to handle and write any HTML, CSS or JAVASCRIPT to get the job done, all it needs to do is to create a JSON to define how the interface will be. To create this JSON we have some classes to help you out, so all the developer needs to know is how to call the methods off the class Ewlist/View.

## Install the EwList with Slim Framework

Run this command from the directory in which you want to install.

```bash
composer create-project slim/slim-skeleton [my-app-name]
composer install restaurare/ewlist
```

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writable.

You can create a symlink or copy the latest mobile web build inside de public folder off the slim framework skeleton.
```bash
cd [my-app-name]
ln -s ./vendor/restaurare/ewlist/build/mobile/ ./public/mobile
```

To run the application in development, you can run these commands 

```bash
composer start
```

That's it! Now go build something cool.