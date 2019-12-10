<?php

namespace Drupal\custom_migrate\Plugin\migrate_plus\data_parser;

use Drupal\migrate_plus\DataParserPluginBase;

/**
* Provides a 'DataParser' data parser plugin.
*
* @DataParser(
*  id = "data_parser"
*  title = @Translation("data_parser")
* )
*/
class DataParser extends DataParserPluginBase {

  /**
   * {@inheritdoc}
   */
  protected function openSourceUrl($url) {
    // Plugin logic goes here.
  }

  /**
   * {@inheritdoc}
   */
  protected function fetchNextRow() {
    // Plugin logic goes here.
  }

}
