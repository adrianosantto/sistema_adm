<?php 

namespace App\adms\Controllers\Services;

use App\adms\Helpers\ClearUrl;

/**
 * Recebe a URL e manipula.
 * @author Adriano <adrianosantto@gmail.com>
 */

class PageController
{
    /** @var string $url receber a URL do .htaccess */
    private string $url;

    /**
     * Recebe a URL do .htaccess
     */

    public function __construct()

    {
        echo "Carregar <br><br>";

        if (!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){

                //filter_input(INPUT_GET, 'url', FILTER_DEFAULT)

            $this->url = filter_input(INPUT_GET, 'url');
            

            echo "Acessar o endereço: ". $this->url . "<br><br>";

            $this->url = ClearUrl::clearUrl($this->url);
           var_dump($this->url);

        }else {
            
                echo "Acessar página principal1 <br><br> ";

        }
    }                         

}