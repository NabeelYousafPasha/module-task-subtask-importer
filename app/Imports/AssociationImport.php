<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AssociationImport implements WithMultipleSheets
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            'Governance' => new ModuleTaskSubtaskImport(),
            'Management' => new ModuleTaskSubtaskImport(),
            'Business Model' => new ModuleTaskSubtaskImport(),
            'Operations' => new ModuleTaskSubtaskImport(),
            'Products' => new ModuleTaskSubtaskImport(),
            'Technology' => new ModuleTaskSubtaskImport(),
            'Stakeholders Relations' => new ModuleTaskSubtaskImport(),
            'Human Capital' => new ModuleTaskSubtaskImport(),
        ];
    }
}
