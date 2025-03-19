<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

abstract class ExcelEditor
{
    abstract protected function handle(array $data): array;

    public function addToFile(string $filename, array $data): void
    {
        try {
            if (file_exists($filename)) {
                $spreadsheet = IOFactory::load($filename);
            } else {
                $spreadsheet = new Spreadsheet();
            }

            $sheet = $spreadsheet->getActiveSheet();
            $lastRow = $sheet->getHighestRow();
            $startRow = $lastRow > 1 ? $lastRow + 1 : 2;

            if ($lastRow === 1 && $sheet->getCell('A1')->getValue() === null) {
                $headers = array_keys($data[0]);
                $column = 'A';
                foreach ($headers as $header) {
                    $sheet->setCellValue($column . '1', $header);
                    $column++;
                }
            }

            foreach ($data as $rowIndex => $row) {
                $column = 'A';
                foreach ($row as $value) {
                    $sheet->setCellValue($column . ($startRow + $rowIndex), $value);
                    $column++;
                }
            }

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save($filename);
        } catch (Exception $e) {
            throw new RuntimeException("Error processing Excel file: " . $e->getMessage());
        }
    }
}