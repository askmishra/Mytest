<?php

namespace Drupal\ud_migrations_dependencies_intro\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Provides a 'CustomMigrate' migrate source.
 *
 * @MigrateSource(
 *  id = "custom_migrate",
 *  source_module = "custom_migrate"
 * )
 */
class CustomMigrate extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    return $this->select('media', 'm')
    ->fields('m', array(
      'img_url',
    ))
;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'img_url' => $this->t('img_url'),
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['img_url']['type'] = 'string';
    return $ids;
  }

}
