<?php

namespace Drupal\pix_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for Image content.
 *
 * @MigrateSource(
 *   id = "pix_image"
 * )
 */
class PixImage extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('node');
    $query->join('content_type_pictures', 'pictures', 'node.nid = pictures.nid');
    $query
      ->fields('node', array_keys($this->baseFields()))
      ->fields('pictures', ['field_picture_fid', 'nid'])
      ->condition('node.type', 'pictures', '=');

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = $this->baseFields();

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function baseFields() {
    $fields = [
      'nid' => $this->t('Node ID'),
      'vid' => $this->t('Node revision ID'),
      'title' => $this->t('Node Title'),
      'uid' => $this->t('Author user ID'),
      'created' => $this->t('Created date UNIX timestamp'),
      'changed' => $this->t('Updated date UNIX timestamp'),
      'status' => $this->t('Node publication status'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'nid' => [
        'type' => 'integer',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    // Get Node revision body and teaser/summary value.
    $revision_data = $this->select('node_revisions')
      ->condition('nid', $row->getSourceProperty('nid'), '=')
      ->condition('vid', $row->getSourceProperty('vid'), '=')
      ->execute()
      ->fetchAll();

    // Get names for this row.
//    $name_tids = $this->select('term_node')
//      ->fields('term_node', ['tid'])
//      ->condition('nid', $row->getSourceProperty('nid'), '=')
//      ->condition('vid', $row->getSourceProperty('vid'), '=')
//      ->execute()
//      ->fetchCol();
//    $row->setSourceProperty('names', $name_tids);

    return parent::prepareRow($row);
  }

}
