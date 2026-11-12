<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Models\RecordManagers\Traits;

/**
 * For RecordManagers of records that belong to a branch (table column id_branch).
 */
trait BelongsToBranch
{
  // Used by branch form tabs, which send ?idBranch=<id>.
  protected function filterByBranchFromUrl(mixed $query): mixed
  {
    $hubleto = \Hubleto\Erp\Loader::getGlobalApp();
    $idBranch = $hubleto->router()->urlParamAsInteger('idBranch');
    if ($idBranch <= 0) return $query;

    return $query->where($this->table . '.id_branch', $idBranch);
  }
}
