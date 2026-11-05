<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Controllers;

class Deficiencies extends \Hubleto\Erp\Controller
{
  public function prepareView(): void
  {
    parent::prepareView();
    $this->setView('@Hubleto:App:External:WaiBlue:OhsBranches/Deficiencies.twig');
  }
}
