<?php

namespace App\Services;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelService
{
    static $alphabet;

    public function __construct()
    {
        self::$alphabet = range('A', 'Z');
    }

    /**
     * @param $class
     * @param array $fields
     * @param array $joins
     * @param array $wheres
     * @return mixed
     */
    public function getDataFromDatabase($class, $fields = ['*'], $joins = [], $wheres = [])
    {
        $model = $class::select($fields);

        if (count($joins) > 0) {
            foreach ($joins as $join) {
                $model->leftJoin($join[0], $join[1], $join[2], $join[3]);
            }
        }

        if (count($wheres) > 0) {
            foreach ($wheres as $where) {
                $model->where($where[0], $where[1], $where[2]);
            }
        }

        return $model->get()->toArray();
    }

    /**
     * @param $array
     * @param string $name
     * @param array $translates
     * @param string $leaderName
     * @return Spreadsheet
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function createDocument($array, $name = '', $translates = [], $leaderName = '')
    {
        if ($array && ($countCells = count($array)) > 0) {
            $spreadsheet = new Spreadsheet();

            $spreadsheet->getProperties()->setCreator($leaderName)
                ->setLastModifiedBy($leaderName)
                ->setTitle($name)
                ->setSubject($name)
                ->setDescription($name);

            $spreadsheet
                ->setActiveSheetIndex(0)
                ->mergeCells("A1:" . self::$alphabet[$countCells] . 1)
                ->setCellValue('A1', $name);
            $spreadsheet
                ->setActiveSheetIndex(0)
                ->getStyle('A1')
                ->getFont()
                ->setBold(true)
                ->setSize(24);
            $spreadsheet
                ->setActiveSheetIndex(0)
                ->getStyle('A1')
                ->getAlignment()
                ->setHorizontal('center')
                ->setVertical('center');
            foreach ($translates as $key => $translate) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue(
                        (self::$alphabet[$key] . 2),
                        $translate
                    );
                $spreadsheet
                    ->setActiveSheetIndex(0)
                    ->getStyle(self::$alphabet[$key] . 2)
                    ->getFont()
                    ->setBold(true)
                    ->setSize(16);
                $spreadsheet->setActiveSheetIndex(0)->getColumnDimension(self::$alphabet[$key])->setWidth(30);
            }
            $spreadsheet->setActiveSheetIndex(0)->getRowDimension(1)->setRowHeight(40);
            $spreadsheet->setActiveSheetIndex(0)->getRowDimension(2)->setRowHeight(20);
            $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(40);
            $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(40);
            foreach ($array as $parentKey => $items) {
                $spreadsheet->setActiveSheetIndex(0)->getRowDimension($parentKey + 3)->setRowHeight(20);
                foreach ($items as $key => $item) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue(
                            (self::$alphabet[$key] . ($parentKey + 3)),
                            $item ? $item : ''
                        );
                }
            }

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue(
                   'A' . ($countCells + 6),
                    'Подпись руководителя ТЦ:'
                );

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue(
                    'B' . ($countCells + 6),
                    $leaderName
                );


            return $spreadsheet;
        }

        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()->setCreator('Nothing found')
            ->setLastModifiedBy('Nothing found')
            ->setTitle('По выбранному периоду ничего не найдено')
            ->setSubject('По выбранному периоду ничего не найдено')
            ->setDescription('По выбранному периоду ничего не найдено');

        $spreadsheet
            ->setActiveSheetIndex(0)
            ->mergeCells("A1:E1")
            ->setCellValue('A1', 'По выбранному периоду ничего не найдено');
        $spreadsheet
            ->setActiveSheetIndex(0)
            ->getStyle('A1')
            ->getFont()
            ->setBold(true)
            ->setSize(24);
        $spreadsheet
            ->setActiveSheetIndex(0)
            ->getStyle('A1')
            ->getAlignment()
            ->setHorizontal('center')
            ->setVertical('center');
        $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('A')->setWidth(40);
        $spreadsheet->setActiveSheetIndex(0)->getRowDimension(1)->setRowHeight(40);

        return $spreadsheet;
    }

    /**
     * @param $spreadsheet
     * @param string $type
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function downloadDocument($spreadsheet, $type = '')
    {
        $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $type . '-report-' . now() . '.xls"');
        $writer->save('php://output');
        exit();
    }

}
