<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Models\Migrations;

use Hubleto\Framework\Migration;

class Deficiency_0001 extends Migration
{
  public function upgradeSchema(): void
  {
    $this->db->execute("CREATE TABLE IF NOT EXISTS `ohs_deficiencies` (
      `id` int(8) primary key auto_increment,
      `id_branch` int(8) NULL DEFAULT NULL,
      `description` text NOT NULL,
      `note` text NULL DEFAULT NULL,
      `id_workflow` int(8) NULL DEFAULT NULL,
      `id_workflow_step` int(8) NULL DEFAULT NULL,
      INDEX `id_branch` (`id_branch`),
      INDEX `id_workflow_step` (`id_workflow_step`)
    ) ENGINE=InnoDB");
  }

  public function downgradeSchema(): void
  {
    $this->db->execute("DROP TABLE IF EXISTS `ohs_deficiencies`");
  }

  public function upgradeForeignKeys(): void
  {
    // A branch with deficiencies cannot be deleted (both legacy apps); branches are deactivated instead.
    $this->db->execute("ALTER TABLE `ohs_deficiencies` ADD CONSTRAINT `fk__ohs_deficiencies__id_branch` FOREIGN KEY (`id_branch`) REFERENCES `ohs_branches` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    $this->db->execute("ALTER TABLE `ohs_deficiencies` ADD CONSTRAINT `fk__ohs_deficiencies__id_workflow` FOREIGN KEY (`id_workflow`) REFERENCES `workflows` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    $this->db->execute("ALTER TABLE `ohs_deficiencies` ADD CONSTRAINT `fk__ohs_deficiencies__id_workflow_step` FOREIGN KEY (`id_workflow_step`) REFERENCES `workflow_steps` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
  }

  public function downgradeForeignKeys(): void
  {
    $this->db->execute("ALTER TABLE `ohs_deficiencies` DROP FOREIGN KEY `fk__ohs_deficiencies__id_branch`");
    $this->db->execute("ALTER TABLE `ohs_deficiencies` DROP FOREIGN KEY `fk__ohs_deficiencies__id_workflow`");
    $this->db->execute("ALTER TABLE `ohs_deficiencies` DROP FOREIGN KEY `fk__ohs_deficiencies__id_workflow_step`");
  }
}
