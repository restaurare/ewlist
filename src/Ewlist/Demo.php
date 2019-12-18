<?php


namespace Ewlist;

use Ewlist\View;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

class Demo 
{

    public function getData() {
        $data = array( 
            array (
                "image"=> "https://images-na.ssl-images-amazon.com/images/I/81L9mVSbluL._SX425_.jpg",
                "title"=> "MCQueen",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce velit augue, interdum eget arcu non, commodo accumsan libero. Pellentesque efficitur metus mi, sed vestibulum odio porta eget. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec finibus, massa ut pulvinar aliquam, sem neque mattis orci, lacinia luctus purus eros et velit. "
            ),
            array (
                "image"=> "https://vignette.wikia.nocookie.net/worldofcarsdrivein/images/7/79/Cars3sally.png/revision/latest?cb=20171029210814",
                "title"=> "Sally",
                "description" => "Cras non dolor sit amet urna bibendum efficitur id vel lacus. Sed viverra ex nec ante imperdiet, sed malesuada nulla egestas. Pellentesque ultricies suscipit justo, non placerat nisl dapibus eget. Quisque mattis nulla nibh, vel ornare tellus tempor nec."
            ),
            array (
                "image"=> "https://vignette.wikia.nocookie.net/disney/images/9/92/Fillmore_DisneyINFINITY.png/revision/latest?cb=20130929083013&path-prefix=es",
                "title"=> "Fillmore",
                "description" => "Nulla porta quam arcu, in semper diam mollis ut. Suspendisse sed felis accumsan, bibendum dolor in, ultrices ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut scelerisque ipsum nisi, vel posuere sapien iaculis sit amet."
            ),
            array (
                "image"=> "https://static.tvtropes.org/pmwiki/pub/images/Mater_4_7146.png",
                "title"=> "Tow Mater",
                "description" => "Vestibulum eget hendrerit quam. Nunc ut diam pharetra, pretium magna ut, placerat urna. Praesent elementum lorem nec erat porta bibendum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at purus est. Maecenas ut ante erat."
            ),
            array (
                "image"=> "https://static.tvtropes.org/pmwiki/pub/images/Doc_Hudson_3_5742.png",
                "title"=> "Doc Hudson",
                "description" => "Cras non dolor sit amet urna bibendum efficitur id vel lacus. Sed viverra ex nec ante imperdiet, sed malesuada nulla egestas. Pellentesque ultricies suscipit justo, non placerat nisl dapibus eget. Quisque mattis nulla nibh, vel ornare tellus tempor nec."
            ),
            array (
                "image"=> "https://static.tvtropes.org/pmwiki/pub/images/Sarge_3_1927.png",
                "title"=> "Sarge",
                "description" => "Cras non dolor sit amet urna bibendum efficitur id vel lacus. Sed viverra ex nec ante imperdiet, sed malesuada nulla egestas. Pellentesque ultricies suscipit justo, non placerat nisl dapibus eget. Quisque mattis nulla nibh, vel ornare tellus tempor nec."
            ),
            array (
                "image"=> "https://static.tvtropes.org/pmwiki/pub/images/Luigi__Guido_5595.png",
                "title"=> "Luigi e Guido",
                "description" => "Cras non dolor sit amet urna bibendum efficitur id vel lacus. Sed viverra ex nec ante imperdiet, sed malesuada nulla egestas. Pellentesque ultricies suscipit justo, non placerat nisl dapibus eget. Quisque mattis nulla nibh, vel ornare tellus tempor nec."
            )
        );
        return $data;
    }

    public function getImagesView($request, $response, $args) {
        $data = $this->getData();

        $view = new View();
        $view->hideSearch(true);
        $view->setWidgetTitle("Imagens");

        $page = 0;

        $action = "ew_close";
        $params = array();

        foreach ($data as $item) {
            
            if ($viewType == "cards") {
                $view->addPaperCardImage($item['image'],$item['title'],$item['description'],$action,$params);
            } else {
                $view->addPage("Página " . (intval($page) + 1)) ;   
                $view->addImageItem($item['image'],$page,"100%","300px","contain");
                $page = $page + 1;
            }
            
        }
        if ($viewType == "slideshow") {
            $view->hidePages(true);
            $view->autoScrollPages(true,5,false);
        }
        return  $response->withJson($view); 
    }

    public function getListView($request, $response, $args) {
        $data = $this->getData();

        $view = new View();
        $view->setWidgetTitle("Exemplo de Listagem");
        $view->hidePages(false);

        $action = "ew_close";
        $params = array();


        $view->addPage("Normal","social:person");
        $view->addHeaderItem("Items com Icones");
        foreach ($data as $item) {            
            $view->addPaperItemIcon("social:person",$item['title'],$item['description'],$action,$params);
        }

        $view->addPage("Small","social:person");
        $view->addHeaderItem("Items com Icones");
        foreach ($data as $item) {            
            $view->addPaperItemIcon("social:person",$item['title'],$item['description'],$action,$params,true,"small");
        }

        $view->addPage("Medium","social:person");
        $view->addHeaderItem("Items com Icones");
        foreach ($data as $item) {            
            $view->addPaperItemIcon("social:person",$item['title'],$item['description'],$action,$params,true,"medium");
        }

        $view->addPage("Cards","image:burst-mode");
        $view->addHeaderItem("Imagens em Paper Cards");
        foreach ($data as $item) {            
            $view->addPaperCardImage($item['image'],$item['title'],$item['description'],$action,$params,true,array(),1);
            $view->updateLastItem($view->getLastItem()->setDate("14/10/2018")->addActionButton("social:share",$action,$params)->addActionButton("create",$action,$params));
        }

        $view->addPage("Images","image:image");
        $view->addHeaderItem("Imagens 2");
        foreach ($data as $item) {     
            $view->addPaperItemImage($item['image'],$item['title'],$item['description'],$action,$params);       
            $view->updateLastItem($view->getLastItem()->addActionButton("social:person",$action,$params)->addActionButton("create",$action,$params));
        }

        $view->setFab("arrow-back","Voltar","ew_close");        
        return $response->withJson($view); 
    }

    public function getFormView($request, $response, $args) {
        $view = new View("Formulário");

        $params = $request->getParams();

        $send = $params["send"];
        if ($send == "1") {

            //FAÇA AQUI A AÇÃO DE SALVAR OS DADOS DO FORMULARIO.
            //UTILIZE O getParam para recuperar os valores enviados.
            $name = $params["name"];
            $view->showMessage("Dados Enviados com Sucesso!");
            $view->addErrorItem("Dados foram enviados com sucesso! Nome: " . $name);
            $view->setFab("close","Voltar","ew_close");

            // print_r($_FILES);
        } else {

            $systems = array("Opcao 1","Opcao 2","Opcao 3");

            $view->addPaperDropDownMenu("systemID","Sistema",2,$systems,false,"Informe o Sistema.","social:share");

            $view->addRadios("msgTo","Para:",-1,$systems,false,"","mail");

            $view->addTextInput("name","Nome","JOAO DA SILVA",false,"Nome","social:person");
            $view->addTextInput("email","E-mail","",false,"","mail");
            $view->addTextAreaInput("descricao","Observações","",false,"Observações.","social:share");
       //     $view->addDateInput("dateIni","Data de início","14/10/2018",false,"Data de Início");

            $view->addCheckbox("enabled","Ativado",false);

            $view->addUploadFile("iconImage");

            $view->addHiddenInput("send","1");
            $view->addHiddenInput("route","/demo/forms");
            $view->addHiddenInput("view","form");
            $view->setFab("send","Enviar","ew_send");
        }

        return $response->withJson($view); 
    }

    public function getMenuView($request, $response, $args) {
        $view = new View("Menu");

        $route = "home";

        $action = "ew-list-view";

        $view->addHeaderItem("Demonstração do List-View");
        $view->addPaperItemIcon("editor:format-align-justify","Listagem","Exemplo de lista de items.",$action,array("route" => "/demo/list"));
        $view->addPaperItemIcon("social:share","Formulários","Exemplo de utilização de formularios.",$action,array("route" => "/demo/forms"));
        
        $view->addHeaderItem("Imagens");
        $view->addPaperItemIcon("image:collections","SlideShow","Exemplo de slideshow de imagens.",$action,array("route" => "/demo/images"));
        // $view->addPaperItemIcon("image:collections","Cards","Exemplo de cards de imagens.",$action,$params);

        $view->runAction("ew-list-view",array("route" => "/demo/home"));

        return $response->withJson($view); 
    }

    public function getHomeView($request, $response, $args) {
        $view = new View("Home");
        
        return $response->withJson($view); 
    }


}

?>