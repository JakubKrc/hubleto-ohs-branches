<?php

namespace Hubleto\App\External\WaiBlue\OhsBranches\Models;

use Hubleto\App\Community\Workflow\Models\Workflow;
use Hubleto\App\Community\Workflow\Models\WorkflowStep;
use Hubleto\Framework\Db\Column\Lookup;
use Hubleto\Framework\Db\Column\Text;

/**
 * Deficiency found at a branch. Both legacy apps keep the text, a note and whether it is resolved
 * (one a state, the other a due date); here the state is a Workflow step, so Hubleto keeps its history.
 */
class Deficiency extends \Hubleto\Erp\Model
{
  const WORKFLOW_GROUP = 'ohs_deficiencies';

  public string $table = 'ohs_deficiencies';
  public string $recordManagerClass = RecordManagers\Deficiency::class;
  public ?string $lookupSqlValue = 'left({%TABLE%}.description, 80)';
  public ?string $lookupUrlDetail = 'ohs/branches/deficiencies/{%ID%}';

  public array $relations = [
    'BRANCH' => [ self::BELONGS_TO, Branch::class, 'id_branch', 'id' ],
    'WORKFLOW' => [ self::BELONGS_TO, Workflow::class, 'id_workflow', 'id' ],
    'WORKFLOW_STEP' => [ self::BELONGS_TO, WorkflowStep::class, 'id_workflow_step', 'id' ],
  ];

  public function describeColumns(): array
  {
    return array_merge(parent::describeColumns(), [
      'id_branch' => (new Lookup($this, $this->translate('Branch'), Branch::class, 'RESTRICT'))->setRequired()->setDefaultVisible(),
      'description' => (new Text($this, $this->translate('Deficiency')))->setRequired()->setDefaultVisible(),
      'note' => (new Text($this, $this->translate('Note')))->setDefaultVisible(),
      'id_workflow' => (new Lookup($this, $this->translate('Workflow'), Workflow::class))->setReadonly(),
      'id_workflow_step' => (new Lookup($this, $this->translate('Status'), WorkflowStep::class))->setDefaultVisible()->setReadonly(),
    ]);
  }

  public function describeTable(): \Hubleto\Framework\Description\Table
  {
    $description = parent::describeTable();
    $description->ui['addButtonText'] = $this->translate('Add deficiency');
    $description->addFilter('fDeficiencyStatus', Workflow::buildTableFilterForWorkflowSteps($this, $this->translate('Status')));
    $description->show(['header', 'fulltextSearch', 'columnSearch', 'moreActionsButton']);
    $description->hide(['footer']);
    // In the branch's tab the branch is known, so its column is left out (both legacy apps).
    if ($this->router()->urlParamAsInteger('idBranch') > 0) $description->hideColumns(['id_branch']);
    return $description;
  }

  public function describeForm(): \Hubleto\Framework\Description\Form
  {
    return parent::describeForm();
  }

  public function getRelationsIncludedInLoadTableData(): array|null
  {
    return ['BRANCH', 'WORKFLOW_STEP'];
  }

  public function getMaxReadLevelForLoadTableData(): int
  {
    return 1;
  }

  public function onBeforeCreate(array $record): array
  {
    $record = parent::onBeforeCreate($record);

    // New deficiencies start in the first step of the deficiency workflow ("newly found").
    /** @var Workflow */
    $mWorkflow = $this->getModel(Workflow::class);
    return $mWorkflow->applyDefaultWorkflow($record, self::WORKFLOW_GROUP);
  }

  // The branch stays as created (both legacy apps).
  public function onBeforeUpdate(array $record): array
  {
    $record = parent::onBeforeUpdate($record);

    $storedDeficiency = $this->record->where('id', (int) $record['id'])->first();
    if ($storedDeficiency) {
      $record['id_branch'] = $storedDeficiency->id_branch;
    }

    return $record;
  }
}
