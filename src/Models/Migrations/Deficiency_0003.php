<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Models\Migrations;

use Hubleto\Framework\Migration;

// Foreign keys of the workflow state (models and lookups review B6).
class Deficiency_0003 extends Migration
{
  public function upgradeSchema(): void
  {
  }

  public function downgradeSchema(): void
  {
  }

  public function upgradeForeignKeys(): void
  {
    $this->db->execute("ALTER TABLE `ohs_deficiencies` ADD CONSTRAINT `fk__ohs_deficiencies__id_workflow` FOREIGN KEY (`id_workflow`) REFERENCES `workflows` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
    $this->db->execute("ALTER TABLE `ohs_deficiencies` ADD CONSTRAINT `fk__ohs_deficiencies__id_workflow_step` FOREIGN KEY (`id_workflow_step`) REFERENCES `workflow_steps` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT");
  }

  public function downgradeForeignKeys(): void
  {
    $this->db->execute("ALTER TABLE `ohs_deficiencies` DROP FOREIGN KEY `fk__ohs_deficiencies__id_workflow`");
    $this->db->execute("ALTER TABLE `ohs_deficiencies` DROP FOREIGN KEY `fk__ohs_deficiencies__id_workflow_step`");
  }
}
