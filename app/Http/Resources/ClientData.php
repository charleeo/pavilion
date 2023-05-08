<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientData extends JsonResource
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
            'id' => $this->id,
            'name' => $this->firstname . " " . $this->lastname,
            'email' => $this->email,
            'profile_image' => $this->profile_image,
            'detail' => substr($this->case_detail,0,20),
            'date_profiled' => Carbon::createFromDate($this->date_profiled)->format("d-m-Y"),
        ];
    }
}
