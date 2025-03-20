<?php

namespace App\adms\Models\Services;

use App\adms\Helpers\GenerateLog;
use PDO;
use PDOException;

/**
 * Conexão com o banco de dados
 *
 * @author Adriano Santto <adrianosantto@gmail.com>
 */

abstract class DbConnection
{
  /** @var object $connect Recebe a conexão com o banco de dados */
  private object $connect;

  /**
   * Realiza a conexão com o banco de dados.
   * Não realizando o conexão corretamente, para o processamento da página e apresenta a mensagem de erro, com o e-mail de contato do administrador
   * @return object retorna a conexão com o banco de dados
   */
  public function getConnection(): object
  {
    try
    {

        //Conexão com a porta
        //$this-> connect = new PDO("mysql:host={$_ENV['DB_HOST']};$_ENV['DB_PORT'];dbname=".$_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
        //echo "Conexão com banco de dados realizado com sucesso!<br>";
        


        // Conexao sem a porta
        $this-> connect = new PDO("mysql:host={$_ENV['DB_HOST']};dbname=".$_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
        //echo "Conexão com banco de dados realizado com sucesso!<br>";

        return $this->connect;


    } catch(PDOException $err)
    {
        // Chamar o método para salvar o log
        GenerateLog::generateLog("alert", "Conexão com banco de dados não realizado.", ['error' => $err->getMessage()]);

        die("Erro 001: Por favor tente novamente. Caso o problema persista, entre em contato o administrador <a>{$_ENV['EMAIL_ADM']}</a>");
    }
  }
  
}