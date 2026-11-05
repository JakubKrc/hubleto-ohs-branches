<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Models\Migrations;

use Hubleto\Framework\Migration;

// A branch with job positions cannot be deleted (both legacy apps); branches are deactivated instead.
class Job_0002 extends Migration
{
  public function upgradeSchema(): void
  {
  }

  public function downgradeSchema(): void
  {
  }

  public function upgradeForeignKeys(): void
  {
    $this->db->execute("ALTER TABLE `ohs_jobs` DROP FOREIGN KEY `fk__ohs_jobs__id_branch`");
    $this->db->execute("ALTER TABLE `ohs_jobs` ADD CONSTRAINT `fk__ohs_jobs__id_branch` FOREIGN KEY (`id_branch`) REFERENCES `ohs_branches` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
  }

  public function downgradeForeignKeys(): void
  {
    $this->db->execute("ALTER TABLE `ohs_jobs` DROP FOREIGN KEY `fk__ohs_jobs__id_branch`");
    $this->db->execute("ALTER TABLE `ohs_jobs` ADD CONSTRAINT `fk__ohs_jobs__id_branch` FOREIGN KEY (`id_branch`) REFERENCES `ohs_branches` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT");
  }
}
