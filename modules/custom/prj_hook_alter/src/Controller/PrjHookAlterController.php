<?php


namespace Drupal\prj_hook_alter\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Access\AccessResult;


/**
 * Controller for export json.
 * Access checker code for evaluating the site api key and node content type
 */
class PrjHookAlterController extends ControllerBase {
  /**
   * {@inheritdoc}
   */
  public function content($apikey, $node) {
    $nodeDetails = (array)$node;
    return new JsonResponse(['data' => $nodeDetails]);

  }
  /**
   * {@inheritdoc}
   */
  public function access($apikey, NodeInterface $node) {
    $siteApiKey = \Drupal::config('system.site')->get('siteapikey');
    return AccessResult::allowedIf($apikey == $siteApiKey && $node->getType() == 'page');
  }
}
