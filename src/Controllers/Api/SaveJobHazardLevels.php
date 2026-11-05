<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Controllers\Api;

use Hubleto\App\External\WaiBlue\OhsBranches\Services\JobHazardLevels;

class SaveJobHazardLevels extends \Hubleto\Erp\Controllers\ApiController
{
  public function renderJson(): array
  {
    $idJob = $this->router()->urlParamAsInteger('idJob');
    $levelsByHazard = $this->router()->urlParamAsArray('levels');

    try {
      $this->getService(JobHazardLevels::class)->saveLevels($idJob, $levelsByHazard);
      return ['status' => 'success'];
    } catch (\Throwable $exception) {
      return ['status' => 'error', 'message' => $exception->getMessage()];
    }
  }
}
