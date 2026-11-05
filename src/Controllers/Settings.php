<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Controllers;

class Settings extends \Hubleto\Erp\Controller
{
  public function getBreadcrumbs(): array
  {
    return array_merge(parent::getBreadcrumbs(), [
      ['url' => 'ohs/branches', 'content' => $this->translate('Branches')],
      ['url' => 'settings', 'content' => $this->translate('Settings')],
    ]);
  }

  public function prepareView(): void
  {
    parent::prepareView();

    // Only administrators and managers change workflows (the record write rules).
    /** @var \Hubleto\App\External\WaiBlue\OhsCore\Services\Roles */
    $roles = $this->getService(\Hubleto\App\External\WaiBlue\OhsCore\Services\Roles::class);
    $this->viewParams['mayEditWorkflows'] = $roles->isActiveUserAdministratorOrManager();

    $this->setView('@Hubleto:App:External:WaiBlue:OhsBranches/Settings.twig');
  }
}
