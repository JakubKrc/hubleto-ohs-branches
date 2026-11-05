<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Models\Migrations;

use Hubleto\Framework\Migration;

// Job names are unique per branch (models and lookups review C5). Job::refuseInvalidJob() gives the message.
class Job_0003 extends Migration
{
  public function upgradeSchema(): void
  {
    $this->db->execute("ALTER TABLE `ohs_jobs` ADD UNIQUE INDEX `branch_job_name` (`id_branch`, `name`)");
  }

  public function downgradeSchema(): void
  {
    $this->db->execute("ALTER TABLE `ohs_jobs` DROP INDEX `branch_job_name`");
  }

  public function upgradeForeignKeys(): void
  {
  }

  public function downgradeForeignKeys(): void
  {
  }
}
