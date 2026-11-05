<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Controllers;

class BranchTypes extends \Hubleto\Erp\Controller
{
  public function prepareView(): void
  {
    parent::prepareView();
    $this->setView('@Hubleto:App:External:WaiBlue:OhsBranches/BranchTypes.twig');
  }
}
