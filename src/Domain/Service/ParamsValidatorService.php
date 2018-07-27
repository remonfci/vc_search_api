<?php
declare(strict_types=1);

namespace Api\Domain\Service;

/**
 * Class ParamsValidatorService
 * This Service is used to prepare and validate query string params.
 *
 * @author Remon Adel <r.naeem.fcih@gmail.com>
 */
class ParamsValidatorService implements ParamsValidatorInterface
{
    /**
     * Required param error text
     */
    const REQUIRED_PARAM_ERROR = "This field couldn't be empty!";

    /**
     * Invalid param error text
     */
    const INVALID_PARAM_ERROR = "This field can only be a number!";

    /**
     * @var array $queryStringParams
     */
    protected $queryStringParams = [];

    /**
     * ParamsValidatorService constructor.
     * @param array $queryStringParams
     */
    public function __construct(array $queryStringParams)
    {
        $this->queryStringParams = $queryStringParams;
    }

    /**
     * This method is used to validate query string params.
     *
     * @param array $queryStringMapperArray
     * @return array
     */
    public function validate(array $queryStringMapperArray) : array
    {
        $params = [];
        $errors = [];
        $errors['error_count'] = 0;

        if (isset($this->queryStringParams['q']) && !empty($this->queryStringParams['q'])) {
            $params[$queryStringMapperArray['q']] = $this->queryStringParams['q'];
            unset($queryStringMapperArray['q']);
        } else {
            $errors['error_count']++;
            $errors['errors']['q'] =  self::REQUIRED_PARAM_ERROR;
        }

        foreach ($queryStringMapperArray as $paramName => $paramValue) {
            if ($this->isValidParam($this->queryStringParams[$paramName])) {
                $params[$paramValue] = $this->queryStringParams[$paramName];
            } else {
                $errors['error_count']++;
                $errors['errors'][$paramName] = self::INVALID_PARAM_ERROR;
            }
        }

        $params = array_filter($params, 'strlen');

        if ($errors['error_count'] > 0) {
            return $errors;
        } else {
            return $params;
        }
    }

    /**
     * @param $param
     * @return bool
     */
    private function isValidParam($param) : bool
    {
        if (isset($this->queryStringParams[$param]) &&
            is_numeric($this->queryStringParams[$param]) &&
            $this->queryStringParams[$param] != 0) {
            return true;
        } else {
            return true;
        }
    }
}
