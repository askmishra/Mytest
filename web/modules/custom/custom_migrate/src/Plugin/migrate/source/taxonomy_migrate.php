<?php

namespace Drupal\custom_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Provides a 'taxonomy_migrate' migrate source.
 *
 * @MigrateSource(
 *  id = "taxonomy_migrate",
 *  source_module = "custom_migrate"
 * )
 */
class taxonomy_migrate extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('dummy', 'g')
      ->fields('g', [
          'id',
          'name'
        
        ]);
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'id' => $this->t('id'),
       'name' => $this->t('name'),
    ];
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
 /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'id' => [
        'type' => 'integer',
        'alias' => 'g',
      ],
    ];
  }

}
