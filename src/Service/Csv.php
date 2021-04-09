<?php

declare(strict_types=1);

namespace Ablabs\CommissionTask\Service;

class Csv
{
    private $_file;
    private $_path;
    public $csvData = [];

    public function __construct($path)
    {
        $this->_file = fopen($path, "r");
        $this->_path = $path;
    }

    public function closeFile()
    {
        fclose($this->_file);
    }

    public function readFile()
    {
        return fgetcsv($this->_file);
    }

    public function storeData()
    {
        $csv = new Csv($this->_path);
        while (($line = $csv->readFile()) !== false) {
            //Do what you wanna do
            array_push($csvData, $line);
        }

        //When done, close it
        $csv->closeFile();
    }
}
