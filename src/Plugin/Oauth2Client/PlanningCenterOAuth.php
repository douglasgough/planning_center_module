<?php

declare(strict_types=1);

namespace Drupal\planning_center\Plugin\Oauth2Client;

use Drupal\Core\Url;
use Drupal\oauth2_client\Plugin\Oauth2Client\Oauth2ClientPluginBase;
use Drupal\oauth2_client\Plugin\Oauth2Client\Oauth2ClientPluginRedirectInterface;
use Drupal\oauth2_client\Plugin\Oauth2Client\TempStoreTokenStorage;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Auth Code with redirect plugin.
 *
 * @Oauth2Client(
 *   id = "planning_center_oauth",
 *   name = @Translation("Authenticate with Planning Center."),
 *   grant_type = "authorization_code",
 *   authorization_uri = "https://api.planningcenteronline.com/oauth/authorize",
 *   token_uri = "https://api.planningcenteronline.com/oauth/token",
 *   resource_owner_uri = "https://api.planningcenteronline.com/me",
 *   scopes = {"people,calendar"},
 * )
 */
class PlanningCenterOAuth extends Oauth2ClientPluginBase implements Oauth2ClientPluginRedirectInterface {

  /*
   * This example assumes that a user is authenticating against a third-party
   * service to retrieve a token that Drupal can use to access resources on
   * that user's behalf.
   */
  use TempStoreTokenStorage;

  /**
   * {@inheritdoc}
   */
  public function getPostCaptureRedirect(): RedirectResponse {
    // After capturing the token, go to the site homepage.
    $url = Url::fromRoute('<front>');
    return new RedirectResponse($url->toString(TRUE)->getGeneratedUrl());
  }

}
