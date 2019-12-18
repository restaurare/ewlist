# Restaurare Web-Mobile is a fast tool to develop a mobile site.

This component is a new way to rapid develop web-mobile applications, almost anyone can create a mobile web app in less then 10 minutes using the most recent technologies like web-components, material design, etc...

You can build amazing web-mobile site interfaces, totaly user friendly, resolution adjustable by just creating and defining a JSON. That's it, you just get any 'data' from your database, format your data to our JSON standard (we have some helpers for you) and define your interface, and your site is DONE.

The concept behind this component, is that the developer doesn't need to handle and write any HTML, CSS or JAVASCRIPT to get the job done, all it needs to do is to create a JSON to define how the interface will be. To create this JSON we have some classes to help you out, so all the developer needs to know is how to call the methods off the class Ewlist/View.

Initialy i'm using Slim Framework to create the REST routes, but i wish in the near future to create a laravel package for this repository.

## Install the EwList with slim Framework

Run this command from the directory in which you want to install.

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writable.

##Docker or Composer

To run composer, you can install composer on your computer, or just use the docker composer container.
```bash
docker run --rm -it --volume $(pwd):/app prooph/composer:7.2 [your composer command]
```

```bash
composer create-project slim/slim-skeleton [my-app-name]
cd [my-app-name]
composer require restaurare/ewlist "dev-master"
```

You don't need to know any of HTML, CSS or JAVASCRIPT, you just need to create a symlink or copy the latest mobile web build inside de public folder off the slim framework skeleton.
```bash
cd public
ln -s ../vendor/restaurare/ewlist/build/mobile/ ./public/mobile
```

Edit the file "src/routes.php" with the following content:

```php
<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

use Ewlist\AppList;

return function (App $app) {
    $container = $app->getContainer();

    $ewApp = new Ewlist\AppList($app);

    //This is the /demo/menu route
    //you can develop your own routes and replace the startup route here.

    $app = $ewApp->addRoutes($app,"/demo/menu"); 
    $app = $ewApp->addDemoRoutes($app);

    $app->post('/menu', function($request, $response, $args) {
        $view = new Ewlist\View("Top Cars 2020");
        //ADD MENU CATEGORY DIVIDER
        $view->addHeaderItem("Categories");
        //MENU ITEMS
        $view->addPaperItemIcon("maps:directions-car","Super Cars","Expensive cars in 2020.","ew-list-view",array("route" => "/cars/super"));
        $view->addPaperItemIcon("maps:directions-car","Normal Cars","Normal cars in 2020.","ew-list-view",array("route" => "/cars/normal"));
        // CALL ANOTHER ROUTE WHEN THIS ROUTE LOADS.
        // $view->runAction("ew-list-view",array("route" => "/cars/super"));
        //ADD ACTION BUTTON
        $view->addActionToolbarButton("refresh","ew_refresh",array());
        //ADD HTML
        $view->addHTML("<b>Teste de HTML</b>");
        $view->showMessage("Welcome to Restaurare!");
        return $response->withJson($view);
    });

};


```

Dump-autoload from composer and Optimize with "-o" option, 
To run the application in development, you can run these commands 

```bash
composer dump-autoload -o
composer start
```

Access the URL in Your Browser: 
    http://localhost:8080/

We have some DEMO routes to show you how to doo things, take a look at the file: 
vendor/restaurare/ewlist/src/Ewlist/Demo.php

Ass soon as i can, i will add more samples...

That's it! Now go build something cool.
