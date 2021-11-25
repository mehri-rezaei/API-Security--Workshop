<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'channel_id' => $this->channel_id,
            'name' => $this->name,
            'description' => $this->description,
            'subscribers' => $this->subscribers,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at



        ];
    }
}
