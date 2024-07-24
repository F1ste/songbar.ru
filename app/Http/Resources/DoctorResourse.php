<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'doctor_id' => $this->id,
            'doctor_fio' => $this->lastname.' '.$this->name.' '.$this->patronymic
           ];
        //return parent::toArray($request);
    }
}
