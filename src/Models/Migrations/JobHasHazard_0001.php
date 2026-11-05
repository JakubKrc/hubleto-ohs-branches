<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Models\Migrations;

use Hubleto\Framework\Migration;

class JobHasHazard_0001 extends Migration
{
  public function upgradeSchema(): void
  {
    $this->db->execute("CREATE TABLE IF NOT EXISTS `ohs_job_has_hazards` (
      `id` int(8) primary key auto_increment,
      `id_job` int(8) NULL DEFAULT NULL,
      `id_hazard` int(8) NULL DEFAULT NULL,
      `level` int(1) NOT NULL DEFAULT 0,
      UNIQUE INDEX `job_hazard` (`id_job`, `id_hazard`),
      INDEX `id_hazard` (`id_hazard`)
    ) ENGINE=InnoDB");
  }

  public function downgradeSchema(): void
  {
    $this->db->execute("DROP TABLE IF EXISTS `ohs_job_has_hazards`");
  }

  public function upgradeForeignKeys(): void
  {
    $this->db->execute("ALTER TABLE `ohs_job_has_hazards` ADD CONSTRAINT `fk__ohs_job_has_hazards__id_job` FOREIGN KEY (`id_job`) REFERENCES `ohs_jobs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT");
    $this->db->execute("ALTER TABLE `ohs_job_has_hazards` ADD CONSTRAINT `fk__ohs_job_has_hazards__id_hazard` FOREIGN KEY (`id_hazard`) REFERENCES `ohs_hazards` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
  }

  public function downgradeForeignKeys(): void
  {
    $this->db->execute("ALTER TABLE `ohs_job_has_hazards` DROP FOREIGN KEY `fk__ohs_job_has_hazards__id_job`");
    $this->db->execute("ALTER TABLE `ohs_job_has_hazards` DROP FOREIGN KEY `fk__ohs_job_has_hazards__id_hazard`");
  }
}
