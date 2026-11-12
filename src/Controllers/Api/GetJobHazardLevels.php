<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Controllers\Api;

use Hubleto\App\External\WaiBlue\OhsBranches\Services\JobHazardLevels;

class GetJobHazardLevels extends \Hubleto\Erp\Controllers\ApiController
{
  public function renderJson(): array
  {
    $idJob = $this->router()->urlParamAsInteger('idJob');

    /** @var JobHazardLevels */
    $jobHazardLevels = $this->getService(JobHazardLevels::class);

    return [
      'status' => 'success',
      'hazardTypes' => $jobHazardLevels->getLevelsGroupedByHazardType($idJob),
    ];
  }
}
