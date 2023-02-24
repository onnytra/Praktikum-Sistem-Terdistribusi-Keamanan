<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class movies extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'tanggal' => $this->tanggal,
            'genre' => $this->genre,
            'sinopsis' => $this->sinopsis,
            'poster' => $this->poster,
            'poster_live' => $this->live->poster,
        ];
    }
}
