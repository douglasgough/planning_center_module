<?php

declare(strict_types=1);

namespace Drupal\planning_center;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a planning center event entity type.
 */
interface PlanningCenterEventInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
