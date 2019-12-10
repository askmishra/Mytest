<?php

/**
 * @file
 * CustomModalController class.
 */

namespace Drupal\custom_modal\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;

class CustomModalController extends ControllerBase {

  public function modal() {
    $options = [
      'dialogClass' => 'popup-dialog-class',
      'width' => '50%',
    ];
    $form = \Drupal::formBuilder()->getForm(\Drupal\user\Form\UserLoginForm::class);


  //  print_r($form);exit;
    $response = new AjaxResponse();
    $response->addCommand(new OpenModalDialogCommand(t('Modal title'), $form, $options));

    return $response;
  }
}