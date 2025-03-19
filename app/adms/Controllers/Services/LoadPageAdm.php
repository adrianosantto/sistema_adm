<?php 

namespace App\adms\Controllers\Services;

use App\adms\Helpers\GenerateLog;

class LoadPageAdm
{

    /** @var string $urlController Recebe da URL o nome da controller */
    private string $urlController;
    /** @var string $urlParameter Recebe da URL o parâmetro */
    private string $urlParameter;
    /** @var string $classLoad Controller que deve ser carregada */
    private string $classLoad;
    /** @var array $listPgPublic Recebe a lista de páginas públicas */
    private array $listPgPublic = ["Login"];
    /** @var array $listPgPrivate Recebe a lista de páginas privadas */
    private array $listPgPrivate = ["Dashboard", "ListUsers"];
    /** @var array $listDirectory Recebe a lista de diretórios com as controllers */
    private array $listDirectory = ["login", "dashboard", "users"];
    /** @var array $listDirectory Recebe a lista de diretórios com as controllers */
    private array $listPackages = ["adms"];

    /**
     * Verificar se existe a página com o método checkPageExists
     * Verificar se e existe a classe com o método checkControllersExists
     * @param string $urlController Recebe da URL o nome da controller
     * @param string $urlParameter Recebe da URL o parâmetro
     * 
     * @return void
     */

    public function loadPageAdm(string|null $urlController, string|null $urlParameter ) :void 
    {

        $this->urlController = $urlController;

        $this->urlParameter = $urlParameter;

        //verificar de existe a página
        if (!$this->checkPageExists()) {
            
            //Chamar o método para salvar o log
            GenerateLog::generateLog("error", "Página não encotrada.", ['pagina' => $this->urlController, 'parametro' => $this->urlParameter]);

            die("Página não encotrada");
        }

         //Verificar se a classe existe
         if(!$this->checkControllerExists()) {


            //Chamar o método para salvar o log
            GenerateLog::generateLog("error", "controller naum", ['pagina' => $this->urlController, 'parametro' => $this->urlParameter]);

            die("controller naum");
         }

    }

    /**
     * Verificar se a página existe no array de páginas públicas ou privadas
     * 
     * @return bool
     */

     private function checkPageExists() : bool
     {

        // Verificar se existe a página no array de página pública
        if (in_array($this->urlController, $this->listPgPublic)) {
            
            return true;
        }


        // Verificar se existe a página no array de página privada

        if (in_array($this->urlController, $this->listPgPrivate)) {
            
            return true;
        }

        return false;

     }

     /**
     * Verificar se existe a controller
     * Chamar o método para verificar se existe o método dentro da controller
     * 
     * @return bool
     */
    private function checkControllerExists():bool
    {
        // Percorrer o array de pacotes
        foreach ($this->listPackages as $packge) {

            // Percorrer o array de diretórios
            foreach ($this->listDirectory as $dirertory) {

                // Criar o caminho da controller/classe
                $this->classLoad = "\\App\\$packge\\Controllers\\$dirertory\\".$this->urlController;

                // Verificar se a classe existe
                if (class_exists($this->classLoad)) {

                     // Chamar o método para validar o método
                     $this->loadMetodo();

                    return true;
                }
        
          
            }
                
            
           
        }
        return false;

    }
    /**
     * Verificar se existe o método e carrega a página/controller
     *
     * @return void
     */

     private function loadMetodo():void
     {
        // Instanciar a classe da página que deve ser carregada
        $classLoad = new $this->classLoad();
        if (method_exists($classLoad, "index")) {

            //Carregar metodo
            $classLoad->{"index"}($this->urlParameter);
        }else{


            //Chamar o método para salvar o log
            
            GenerateLog::generateLog("error", "Método não encotrado", ['pagina' => $this->urlController, 'parametro' => $this->urlParameter]);            

            die("Método não encotrado");
        }
     }

}
