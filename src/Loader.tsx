import React from 'react';
import App from '@hubleto/react-ui/core/App'
import Translator from '@hubleto/react-ui/core/Translator';
import FormCustomizer from '@hubleto/react-ui/core/FormCustomizer';
import { type FormMeta } from '@hubleto/react-ui/components/fc/FormInterfaces';
import TableBranches from './Components/FC/TableBranches'
import TableJobs from './Components/FC/TableJobs'
import TableJobHasHazards from './Components/FC/TableJobHasHazards'
import TableBranchHasClinics from './Components/FC/TableBranchHasClinics'
import TableDeficiencies from './Components/FC/TableDeficiencies'
import TableBranchTypes from './Components/FC/TableBranchTypes'

const parentApp = 'Hubleto/App/External/WaiBlue/OhsBranches';
const T = new Translator(parentApp + '/Loader', 'Loader');

// "Prevádzky" tab in the customer form (community Customers app).
function mountCustomerBranchesTab() {
  return {
    title: T.translate('Branches'),
    content: (form: FormMeta) => {
      if (form.id <= 0) return <div className='alert alert-info'>{T.translate('Save the client first.')}</div>;
      return <TableBranches uid={form.uid + '_table_branches'} parentForm={form} idCustomer={form.id} />;
    },
  };
}

class OhsBranchesApp extends App {
  init() {
    super.init();
    globalThis.hubleto.registerReactComponent('OhsBranchesTableBranches', TableBranches);
    globalThis.hubleto.registerReactComponent('OhsBranchesTableJobs', TableJobs);
    globalThis.hubleto.registerReactComponent('OhsBranchesTableJobHasHazards', TableJobHasHazards);
    globalThis.hubleto.registerReactComponent('OhsBranchesTableBranchHasClinics', TableBranchHasClinics);
    globalThis.hubleto.registerReactComponent('OhsBranchesTableDeficiencies', TableDeficiencies);
    globalThis.hubleto.registerReactComponent('OhsBranchesTableBranchTypes', TableBranchTypes);

    FormCustomizer.addTab('FormCustomer', 'ohs-branches', mountCustomerBranchesTab);
  }
}

globalThis.hubleto.registerApp(parentApp, new OhsBranchesApp());
