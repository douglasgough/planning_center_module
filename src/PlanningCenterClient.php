<?php

declare(strict_types=1);

namespace Drupal\planning_center;

use Drupal\Core\Http\ClientFactory;
use Drupal\oauth2_client\Service\Oauth2ClientServiceInterface;

/**
 * Provides a configured OAuth2_client for accessing Planning Center
 */
final class PlanningCenterClient {

  /**
   * Constructs a PlanningCenterClient object.
   */
  public function __construct(
    private readonly Oauth2ClientServiceInterface $oauth2ClientService,
    private readonly ClientFactory $httpClientFactory,
  ) {}

  /**
   * @throws \Drupal\oauth2_client\Exception\InvalidOauth2ClientException
   *
   */
  public function getPlanningCenterClient(): \GuzzleHttp\Client {
    //Needs error handling
    $token = $this->oauth2ClientService->getAccessToken('planning_center_oauth')->getToken();
    return $this->httpClientFactory->fromOptions(
      ['headers' => ['Authorization' => 'Bearer '. $token]]
    );
  }
}
