<?php

namespace Drupal\my_test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;

use Drupal\Core\Database\Driver\mysql\Connection;

/**
 * Class MytestForm.
 */
class MytestForm extends FormBase {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var \Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database ;
  /**
   * Constructs a new MytestForm object.
   */
  public function __construct(
    Connection $database ,AccountInterface $account
  ) {
    $this->database = $database;
	 $this->account = $account;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'), $container->get('current_user')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mytest_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
	  
	
	//  print_r( $this->account->id());
    $form['fname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#description' => $this->t('First Name of User'),
      '#weight' => '0',
    ];
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
	  '#description' => $this->t('Last Name of User'),
      '#weight' => '0',
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
	  '#description' => $this->t('Email of User'),
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
		$email = $form_state->getValue('email');
		$query = $this->database->select('custom_test', 'm');
		$query->fields('m', ['email']);
		$results = $query->execute()->fetchCol();
	  if(in_array($email, $results)) {
		  $form_state->setErrorByName('email', $this->t('Email Already exist!'));
	  }
	 $name = $form_state->getValue('fname');
	  if(preg_match('/[^A-Za-z]/', $name)) {
		 $form_state->setErrorByName('fname', $this->t('your name must in characters without space'));
	  }
     parent::validateForm($form, $form_state);		  
		  
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  $this->database->insert('custom_test')->fields(
	  array(
		'fname' => $form_state->getValue('fname'),
		'email' => $form_state->getValue('email'),
		'lname' => $form_state->getValue('last_name'),
		
	  )
   )->execute();

    drupal_set_message('Data  Submit Successfully ');

  }

}
