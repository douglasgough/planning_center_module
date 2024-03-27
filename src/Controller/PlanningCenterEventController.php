<?php

declare(strict_types=1);

namespace Drupal\planning_center\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\planning_center\PlanningCenterClient;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for Planning Center routes.
 */
final class PlanningCenterEventController extends ControllerBase {

  /**
   * The controller constructor.
   */
  public function __construct(
    private readonly PlanningCenterClient $planningCenterClient
  ) {}

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new self(
      $container->get('planning_center.planning_center_client'),
    );
  }

  /**
   * Builds the response.
   *
   * @throws \Drupal\oauth2_client\Exception\InvalidOauth2ClientException
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function __invoke(): array {
    $response = $this->planningCenterClient
      ->getPlanningCenterClient()
      ->get('https://api.planningcenteronline.com/calendar/v2/events');
    $build['content'] = [
      '#type' => 'item',
      '#markup' => '<pre>' . json_encode(json_decode($response->getBody()->getContents()),JSON_PRETTY_PRINT) . '</pre>',
    ];

    return $build;
  }

}
