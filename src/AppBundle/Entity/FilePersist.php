<?php
namespace AppBundle\Entity;

class FilePersist implements Persistence
{
    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function create(Persistable $persistable)
    {
        $record = $this->getData();
        $persistable->setId(count($record) - 1);

        file_put_contents($this->fileName, json_encode($persistable->getDataToPersist()).PHP_EOL, FILE_APPEND);
    }

    public function research(Persistable $persistable)
    {
        $records = $this->getData();
        $result = null;

        foreach ($records as $record) {
            if (!$record) {
                continue;
            }

            $decodedRecord = json_decode($record);
            if ($decodedRecord->id == $persistable->getId()) {
                $result = $decodedRecord;
                break;
            }
        }

        return $result;
    }

    public function update(Persistable $persistable)
    {
        $records = $this->getData();
        $result = [];
        foreach ($records as $record) {
            $decodedRecord = json_decode($record);
            if ($decodedRecord->id == $persistable->getId()) {
                $decodedRecord = $persistable->getDataToPersist();
            }
            $result[] = json_encode($decodedRecord);
        }

        $records = implode(PHP_EOL, $result);

        file_put_contents($this->fileName, $records);
    }

    public function delete(Persistable $persistable)
    {
        $records = $this->getData();
        $result = [];
        foreach ($records as $record) {
            $decodedRecord = json_decode($record);
            if ($decodedRecord->id == $persistable->getId()) {
                $decodedRecord->id = 'deleted'.$decodedRecord->id;
            }
            $result[] = json_encode($decodedRecord);
        }

        $records = implode(PHP_EOL, $result);
        file_put_contents($this->fileName, $records);
    }

    private function getData()
    {
        $record = file_get_contents($this->fileName);
        $result = explode(PHP_EOL, $record);
        if (!$result[count($result) - 1]) {
            unset($result[count($result) - 1]);
        }

        return $result;
    }

}
