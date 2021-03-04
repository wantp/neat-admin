<?php

namespace Wantp\Neat\Http\Traits;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Box\Spout\Writer\Common\Creator\WriterFactory;
use Box\Spout\Common\Type;
use function request;

trait HasDataExport
{
    protected function __export($data = null)
    {
        $titles = request()->input('export_titles');
        $titles = is_string($titles) ? json_decode($titles, true) : $titles;
        $fileType = request()->input('export_file_type', Type::XLSX);
        $fileName = request()->input('export_file_name','测试.xlsx');

        $reader = WriterFactory::createFromType($fileType);
        $reader->openToBrowser($fileName);
        $titleRow = WriterEntityFactory::createRowFromArray(array_values($titles));
        $reader->addRow($titleRow);

        if (is_null($data)) {
            $data = $this->__index();
            if ($data instanceof JsonResource) {
                $data = $data->resolve();
            }
        }

        foreach ($data as $dataRow) {
            $dataRow = Arr::only($dataRow, array_keys($titles));
            $row = WriterEntityFactory::createRowFromArray($dataRow);
            $reader->addRow($row);
        }
        $reader->close();
    }
}