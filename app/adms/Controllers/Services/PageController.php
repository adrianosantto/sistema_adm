<?php 

namespace App\adms\Controllers\Services;

use App\adms\Helpers\ClearUrl;
use App\adms\Helpers\SlugController;

/**
 * Recebe a URL e manipula.
 * @author Adriano <adrianosantto@gmail.com>
 */

class PageController
{
    /** @var string $url receber a URL do .htaccess */
    private string $url;

    /** @var array $urlArray Recebe a URL convertida para array */
    private array $urlArray;

    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController = "";

    /** @var string $urlParametro Recebe da URL o nome do parametro */    
    private string $urlParameter = "";


    /**
     * Recebe a URL do .htaccess
     */

    public function __construct()

    {
        

        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){

                //filter_input(INPUT_GET, 'url', FILTER_DEFAULT)

            $this->url = filter_input(INPUT_GET, 'url');

            $this->url = ClearUrl::clearUrl($this->url);
           
           // Converter a string da URL em array
           $this->urlArray = explode("/", $this->url);
           

           // Verificar se existe a controller na URL
           if (isset($this->urlArray[0])) {

            // Chamar a classe helper para converter a controller enviada na URL para o formato da classe MINUTO 11:32 Manipular classe e parâmetro

            $this->urlController = SlugController:: slugController($this->urlArray[0]);

            //$this->urlController = $this->urlArray[0];
           }else{

            $this->urlController = SlugController:: slugController("login");

           }

           // Verificar se existe o parâmetro na URL
           if (isset($this->urlArray[1])) {
            
            $this->urlParameter = $this->urlArray[1];
           }


        }else {
            
            $this->urlController = SlugController:: slugController("login");

        }
    }  

    /**
     * Carregar página/controller 
     * Instanciar a classe para validar e carregar página/controller 
     *
     * @return void
     */


    public function loadPage() : void {

        // Instanciar a classe para validar e carregar página/controller 
        $loadPageAdm = new LoadPageAdm();


        // Chamar o método e enviar como parâmetro a controller e o parâmentro da URL
        $loadPageAdm-> loadPageAdm($this->urlController, $this->urlParameter);
    }                       

}