<?php
/**
 * Provides a 'Hello' Block
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 * )
 */
namespace Drupal\zap_initialize\Plugin\Block;
use Drupal\Core\Block\BlockBase;


class HelloBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
  $request = \Drupal::request();
  $route_match = \Drupal::routeMatch();
  $title = \Drupal::service('title_resolver')->getTitle($request, $route_match->getRouteObject());
  return array(
      '#markup' => $title,
  );
  }
}
