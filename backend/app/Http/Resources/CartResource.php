<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request) {
        $courses = $this->courses;

        return [
            'id'          => $this->id,
            'courses'     => $courses,
            'total_count' => $courses->count(),
            'total_price' => $courses->sum('price'),
        ];
    }
}
