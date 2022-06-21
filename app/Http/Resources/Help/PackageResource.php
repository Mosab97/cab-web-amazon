<?php

namespace App\Http\Resources\Help;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $price = $this->package_price;
        $is_discount = false;


        if (@$this->is_discount_active && @$this->start_discount_at && now()->isBetween(@$this->start_discount_at,@$this->end_discount_at)) {
            $price = $price * ($this->discount_percent/100);
            $is_discount = true;
        }



        $package_price = $price;
        $discount_price = $price;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $price,
            'discount_price' => $discount_price,
            'package_price' => $package_price,
            'is_discount_active' => $is_discount,
            'tax' => (float) setting('tax'),
            'duration' => $this->duration,
            'free_duration' => $this->free_duration,
            'month_str' => trans('api.package.months.'.$this->getTransOfMonth($this->duration)),
            'free_month_str' => trans('api.package.months.'.$this->getTransOfMonth($this->free_duration)),
        ];
    }

    protected function getTransOfMonth($month)
    {
        $month_value = 'more';
        switch ($month) {
            case 1:
                $month_value = 'one';
                break;
            case 2:
                $month_value = 'two';
                break;
        }

        return $month_value;
    }
}
