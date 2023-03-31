<?php

namespace App\Source\Helper\Trait;

trait RequiredParamsCheckTrait
{
    public function hasRequiredParams(
        array $requiredParams,
        array $requestParams
    ): bool {
        $requiredParams = array_flip($requiredParams);
        foreach ($requestParams as $param => $value) {
            if (isset($requiredParams[$param])) {
                $requiredParams[$param] = true;
            }
        }

        if (count(array_unique($requiredParams)) === 1) {
            return true;
        }

        return false;
    }
}
