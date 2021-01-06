<?php

namespace Samsin33\Razorpay\Traits;

use Illuminate\Database\Eloquent\Model;

trait CommonTrait
{
    /**
     * Create a Razorpay customer for the given model.
     *
     * @param Model
     * @return Model|bool
     *
     */
    public function saveRecord($object)
    {
        if ($object instanceof Model)
        {
            $object->save();
            return $object;
        }
        return false;
    }
}