<?php

namespace Drupal\planning_center\Feeds\Fetcher;

use Drupal\Core\Config\ImmutableConfig;
use Drupal\feeds\FeedInterface;
use Drupal\feeds\Plugin\Type\Fetcher\FetcherInterface;
use Drupal\feeds\Plugin\Type\PluginBase;
use Drupal\feeds\Result\RawFetcherResult;
use Drupal\feeds\StateInterface;
use Drupal\planning_center\PlanningCenterClient;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Define a fetcher for planningcenteronline.com.
 *
 * @FeedsFetcher(
 *   id = "planning_center_feeds_fetcher",
 *   title = @Translation("Planning Center Feeds Fetcher"),
 *   description = @Translation("Fetch data from planningcenteronline.com"),
 * )
 */

class PlanningCenterFetcher extends PluginBase implements FetcherInterface {

  private PlanningCenterClient $planningCenterClient;

  /**
   * {@inheritdoc}
   * @throws \Drupal\oauth2_client\Exception\InvalidOauth2ClientException
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function fetch(FeedInterface $feed, StateInterface $state): RawFetcherResult {
    $client = \Drupal::getContainer()->get('planning_center.planning_center_client');
    $response = $client
      ->getPlanningCenterClient()
      ->get('https://api.planningcenteronline.com/people/v2/people');
    $result = $response->getBody()->getContents();
    if ($result !== FALSE) {
      return new RawFetcherResult($result);
    }
    else {
      return new RawFetcherResult('');
    }
  }
}
