<?php 

namespace Ewlist;

use Ewlist\Demo;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;


class AppList 
{


    public function addDemoRoutes($app) { 

        $app->post('/demo/menu', '\\Ewlist\Demo:getMenuView');
        $app->post('/demo/home', '\\Ewlist\\Demo:getHomeView');
        $app->post('/demo/list', '\\Ewlist\\Demo:getListView');
        $app->post('/demo/forms', '\\Ewlist\\Demo:getFormView');
        $app->post('/demo/images', '\\Ewlist\\Demo:getImagesView');

      //  $app->get('/demo/menu',$this->addRoutes($app,"/demo/menu"));

        return $app;
    }

    public function addRoutes($app,$default_route = "menu") { 
        $app->get('/', function (Request $request, Response $response, array $args) use ($container,$default_route) {
            $content = file_get_contents(__DIR__ . "/../../build/mobile/index.html");
            $content = str_replace("{DEFAULT_ROUTE}",$default_route,$content);
            $content = str_replace("/src/","/mobile/src/",$content);
            $content = str_replace("bower_components/","mobile/bower_components/",$content);
            return $response->getBody()->write($content);
        });

        return $app;
    }

}


?>