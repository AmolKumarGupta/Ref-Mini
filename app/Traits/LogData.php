<?php

namespace App\Traits;

trait LogData
{
    public function logProp()
    {
        $dirty = $this->getDirty();
        $original = $this->getOriginal();

        $filter = function () use ($original, $dirty) {
            $filtered = [];
            foreach ($dirty as $col=>$val) {
                if (isset($original[$col])) {
                    $filtered[$col] = $original[$col];
                }
            }

            return $filtered;
        };

        return [
            'old' => $filter(),
            'new' => $dirty,
        ];
    }
}
