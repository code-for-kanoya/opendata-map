<?php

namespace App\Exceptions;

/**
 * CSVインポートエラークラス
 */
class CSVException extends \Exception
{
    protected $dataString = "";

    public function __construct($dataString, \Exception $e = null)
    {
        $this->dataString = $dataString;
        $code = 1;
        $message = "CSVImportError! dataString = {$this->dataString}";
        if ($e !== null) {
            $code = $e->getCode();
            $message .= "\nErrorMessage = {$e->getMessage()}";
        }
        parent::__construct($message, $code, $e);
    }

    public function getDataString()
    {
        return $this->dataString;
    }
}
