<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Models\RecordManagers;

use Hubleto\App\External\WaiBlue\OhsCore\Models\RecordManagers\Hazard;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobHasHazard extends \Hubleto\Erp\RecordManager
{
  public $table = 'ohs_job_has_hazards';

  public function JOB(): BelongsTo
  {
    return $this->belongsTo(Job::class, 'id_job', 'id');
  }

  public function HAZARD(): BelongsTo
  {
    return $this->belongsTo(Hazard::class, 'id_hazard', 'id');
  }

  public function addUrlFiltersToQuery(mixed $query): mixed
  {
    $query = parent::addUrlFiltersToQuery($query);

    $hubleto = \Hubleto\Erp\Loader::getGlobalApp();
    $idJob = $hubleto->router()->urlParamAsInteger('idJob');
    if ($idJob > 0) {
      $query = $query->where($this->table . '.id_job', $idJob);
    }

    return $query;
  }

  public function prepareLookupData(array $dataRaw): array
  {
    return parent::prepareLookupData($dataRaw);
  }
}
