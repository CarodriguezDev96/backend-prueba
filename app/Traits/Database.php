<?php

namespace App\Traits;

use App\Models\GeneralLog;

trait Database
{
    /**
     * Save or update a model and return it
     * @param Illuminate\Database\Eloquent\Model $class
     * @param array $data model data
     * @return Illuminate\Database\Eloquent\Model
     *
    */


    public function persist($class, $data)
    {
        $dataId = $data['id'] ?? null;
        $model = $dataId ? $class::find($dataId) : new $class();

        $oldData = $model->toArray();
        $model->fill($data);
        $model->save();

        $modelName = (string) $class;
        if ($dataId) {
            $this->saveGeneralLog($modelName, $dataId, $oldData);
        }

        return $model;
    }

    public function saveGeneralLog($modelName, $entityId, $data)
    {
        $generalLog =  new GeneralLog();
        $generalLog->fill([
          'user_id'   => isset(auth()->user()->id) ? auth()->user()->id : 0,
          'action'    => 'SAVE_UPDATE',
          'entity_id' => $entityId,
          'model'     => $modelName,
          'data'      => json_encode($data),
        ]);
        $generalLog->save();
    }

    public function requestResponse($code, $message, $data)
    {
        $requestResponse['status'] = $code;
        $requestResponse['message'] = $message;
        $requestResponse['data'] = $data;

        return $requestResponse;
    }

}
