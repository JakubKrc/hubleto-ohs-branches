<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Controllers;

class JobHasHazards extends \Hubleto\Erp\Controller
{
  public function prepareView(): void
  {
    parent::prepareView();
    $this->setView('@Hubleto:App:External:WaiBlue:OhsBranches/JobHasHazards.twig');
  }
}
