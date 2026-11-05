<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Controllers;

class Home extends \Hubleto\Erp\Controller
{
  public function prepareView(): void
  {
    parent::prepareView();
    $this->setView('@Hubleto:App:External:WaiBlue:OhsBranches/Home.twig');
  }
}
