<?php

namespace App\Imports;

use App\Models\FailedRow;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectImport implements ToCollection, WithStartRow, WithEvents, WithValidation, SkipsOnFailure
{
    use RegistersEventListeners;

    private Task $task;

    private const STATIC_COLUMNS_COUNT = 13;

    private static array $headings;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $types = $this->getTypes(Type::all());

        foreach ($collection as $row) {
            if(!isset($row[1])) continue;

            $values = $this->getRowsValues($row);

            $statics = $values['static'];
            $project = Project::updateOrCreate(['title' => $statics[1]],
                [
                    'type_id'         => $this->getTypeId($types, $statics[0]),
                    'title'           => $statics[1],
                    'created_at_time' => Date::excelToDateTimeObject($statics[2]) ?? null,
                    'is_chain'        => isset($statics[3]) ? $this->getBool($statics[3]) : null,
                    'worker_count'    => $statics[4] ?? null,
                    'has_outsource'   => isset($statics[5]) ? $this->getBool($statics[5]) : null,
                    'has_investors'   => isset($statics[6]) ? $this->getBool($statics[6]) : null,
                    'deadline'        => Date::excelToDateTimeObject($statics[7] ?? null) ,
                    'is_on_time'      => isset($statics[8]) ? $this->getBool($statics[8]) : null,
                    'contracted_at'   => Date::excelToDateTimeObject($statics[9]),
                    'service_count'   => $statics[10] ?? null,
                    'comment'         => $statics[11] ?? null,
                    'effective_value' => $statics[12] ?? null,
                ]
            );

            if (!isset($values['dynamic'])) continue;

            $dynamicsHeadings = $this->getRowsValues(self::$headings)['dynamic'];
            foreach($values['dynamic'] as $column => $value) {
                Payment::updateOrCreate(
                    [
                        'project_id' => $project->id,
                        'name' => $dynamicsHeadings[$column],
                    ],
                    [
                    'project_id' => $project->id,
                    'name' => $dynamicsHeadings[$column],
                    'value' => $value,
                ]);
            }
        }
    }

    private function getRowsValues($row): array
    {
        $static = [];
        $dynamic = [];

        foreach ($row as $key => $value) {
            if ($value) {
                $key < self::STATIC_COLUMNS_COUNT
                    ? $static[$key] = $value
                    : $dynamic[$key] = $value;
            }
        }

        return [
            'static' => $static,
            'dynamic' => $dynamic
        ];
    }

    public function getTypes($types): array
    {
        $map = [];

        foreach ($types as $type) {
            $map[$type->name] = $type->id;
        }

        return $map;
    }

    private function getTypeId($types, $name)
    {
        return $types[$name] ?? Type::create(['name' => $name])->id;
    }

    private function getBool($value) {
        return $value === 'Да';
    }

    public function startRow(): int
    {
        return 2;
    }

    public static function beforeSheet(BeforeSheet $event)
    {
        self::$headings = $event->sheet->getDelegate()->toArray()[0];
    }

    public function rules(): array
    {
        return array_replace([
            '0' => 'required|string',
            '1' => 'required|string',
            '2' => 'required|integer',
            '3' => 'nullable|string',
            '4' => 'nullable|integer',
            '5' => 'nullable|string',
            '6' => 'nullable|string',
            '7' => 'nullable|integer',
            '8' => 'nullable|string',
            '9' => 'required|integer',
            '10' => 'nullable|integer',
            '11' => 'nullable|string',
            '12' => 'nullable|numeric',
        ], $this->getDynamicRules());
    }

    private function getDynamicRules(): array
    {
        $headers = $this->getRowsValues(self::$headings)['dynamic'];
        foreach ($headers as $column => $value) {
            $headers[$column] = 'required|integer';
        }
        return $headers;
    }

    public function onFailure(Failure ...$failures)
    {
        $fails = [];
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $error) {
                $fails[] = [
                    'column_name' => $this->attributesMap()[$failure->attribute()],
                    'row' => $failure->row(),
                    'message' => $error,
                    'task_id' => $this->task->id,
                ];
            }
        }

        if (count($fails) > 0) $this->insertFailedRows($fails);
    }

    private function insertFailedRows($items)
    {
        foreach ($items as $item) {
            FailedRow::create($item);
        }
        $this->task->update(['status' => Task::STATUS_FAILED]);
    }

    private function attributesMap()
    {
        return array_replace([
            '0' => 'Тип',
            '1' => 'Наименование',
            '2' => 'Дата создания',
            '3' => 'Сетевик',
            '4' => 'Количество участников',
            '5' => 'Наличие аутсорсинга',
            '6' => 'Наличие инвесторов',
            '7' => 'Дедлайн',
            '8' => 'Сдача в срок',
            '9' => 'Подписание договора',
            '10' => 'Количество услуг',
            '11' => 'Комментарий',
            '12' => 'Значение эффективности'
        ], $this->getRowsValues(self::$headings)['dynamic']);
    }
}













