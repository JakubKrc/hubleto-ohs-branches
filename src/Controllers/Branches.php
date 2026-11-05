<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Controllers;

class Branches extends \Hubleto\Erp\Controller
{
  public function prepareView(): void
  {
    parent::prepareView();
    $this->setView('@Hubleto:App:External:WaiBlue:OhsBranches/Branches.twig');
  }
}
