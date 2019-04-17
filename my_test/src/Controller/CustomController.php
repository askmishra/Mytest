<?php

namespace Drupal\my_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class CustomController.
 */
class CustomController extends ControllerBase {

  protected $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  public function display() {
  $header_table = array(
     'id'=>    t('Sr.No'),
      'fname' => t('First Name'),
	   'lname' => t('Last Name'),
	    'email' => t('Email'),
       
    );

/*
   Select data from Custom Table
*/

    $query = $this->database->select('custom_test', 'm');
      $query->fields('m', ['id','fname','lname','email',]);
      $results = $query->execute()->fetchAll();
        $rows=array();
    foreach($results as $data){
             $rows[] = array(
            'id' =>$data->id,
                'fname' => $data->fname,
                'lname' => $data->lname,
                'email' => $data->email,
                
            );

    }
    //display data in site
    $form['table'] = [
            '#type' => 'table',
            '#header' => $header_table,
            '#rows' => $rows,
            '#empty' => t('No users found'),
        ];
        return $form;

  }
}
