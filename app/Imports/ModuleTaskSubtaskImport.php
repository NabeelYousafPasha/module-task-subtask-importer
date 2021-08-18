<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ModuleTaskSubtaskImport implements ToCollection, WithHeadingRow, WithChunkReading
{

    protected const INDUSTRY = 2;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $row = $row->toArray();

            // modules
            if (! is_null($row['module'])) {

                $module = DB::table('modules')
                    ->where('name', '=', $row['module'])
                    ->where('industry_id', '=', self::INDUSTRY)
                    ->first();

                if (is_null($module)) {
                    DB::table('modules')->insert([
                        'name' => $row['module'],
                        'industry_id' => self::INDUSTRY,
                        'description' => $row['module'],
                        'organization_id' => NULL,
                        'created_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $module = DB::table('modules')
                        ->where('name', '=', $row['module'])
                        ->where('industry_id', '=', self::INDUSTRY)
                        ->first();
                }
            }

            // tasks
            if (! is_null($row['name'])) {

                $task = DB::table('tasks')
                    ->where('name', '=', $row['name'])
                    ->where('module_id', '=', $module->id)
                    ->first();

                if (is_null($task)) {
                    DB::table('tasks')->insert([
                        'name' => $row['name'],
                        'reference' => $row['ssc_reference'],
                        'module_id' => $module->id,
                        'description' => $row['task'],
                        'total_score' => $row['score'],
                        'status_id' => 5,
                        'organization_id' => NULL,
                        'created_by' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $task = DB::table('tasks')
                        ->where('name', '=', $row['name'])
                        ->where('module_id', '=', $module->id)
                        ->first();
                }

            }


            // subtasks
            DB::table('subtasks')->insert([
                'name' => $row['subtasks'],
                'reference' => NULL,
                'task_id' => $task->id,
                'description' => NULL,
                'status_id' => 7,
                'organization_id' => NULL,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 20;
    }
}
