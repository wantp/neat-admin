<?php

namespace Wantp\Neat\Http\Traits;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Box\Spout\Writer\Common\Creator\WriterFactory;
use Box\Spout\Common\Type;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function request;

trait HasDataExport
{
    protected function __export($data = null)
    {
        $columns = request()->input('export_columns');
        $columns = is_string($columns) ? json_decode($columns, true) : $columns;
        $fileType = request()->input('export_file_type', Type::XLSX);
        $fileName = request()->input('export_file_name', '');

        $inputs = [
            'export_columns' => $columns,
            'export_file_type' => $fileType,
            'export_file_name' => $fileName,
        ];

        // Param Validate
        $validator = Validator::make($inputs, [
            'export_columns' => 'required|array',
            'export_file_type' => ['required', Rule::in([Type::XLSX, Type::CSV, Type::ODS])],
            'export_file_name' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors()->toArray(),
            ])->send();
        }
        
        // Out put file
        $filenameExtension = '.' . $fileType;
        $fileName = $fileName ? $fileName . $filenameExtension : 'neat_admin_' . Carbon::now()->format('YmdHis') . $filenameExtension;
        $reader = WriterFactory::createFromType($fileType);
        $reader->openToBrowser($fileName);
        $titleRow = WriterEntityFactory::createRowFromArray(array_values($columns));
        $reader->addRow($titleRow);

        if (is_null($data)) {
            $data = $this->__index();
            if ($data instanceof JsonResource) {
                $data = $data->resolve();
            }
        }

        foreach ($data as $dataRow) {
            $dataRow = Arr::only($dataRow, array_keys($columns));
            $row = WriterEntityFactory::createRowFromArray($dataRow);
            $reader->addRow($row);
        }
        $reader->close();
    }
}