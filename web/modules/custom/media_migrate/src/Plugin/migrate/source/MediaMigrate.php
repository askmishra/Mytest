<?php

namespace Drupal\media_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Provides a 'MediaMigrate' migrate source.
 *
 * @MigrateSource(
 *  id = "media_migrate",
 *  source_module = "media_migrate"
 * )
 */
class MediaMigrate extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('media', 'f')
      ->fields('f')
      ->orderBy('f.id');
    return $query;
  }


  /**
   * {@inheritdoc}
   */
  public function fields() {
    return array(
      'id' => $this->t('File ID'),
      'alt' => $this->t('File name'),
      'img_url' => $this->t('The URI to access the file'),
      'filemime' => $this->t('File MIME Type'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['id']['type'] = 'integer';
    return $ids;
  }
}
