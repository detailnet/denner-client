<?php

namespace Denner\Client\Response;

use GuzzleHttp\Message\ResponseInterface as HttpResponseInterface;
use GuzzleHttp\Exception as GuzzleHttpException;

use Denner\Client\Exception;

abstract class BaseResponse implements
    ResponseInterface,
    \ArrayAccess,
    \Countable,
    \IteratorAggregate
{
    use HasDataTrait;

    /**
     * @var HttpResponseInterface
     */
    protected $httpResponse;

    /**
     * @param HttpResponseInterface $response
     */
    public function __construct(HttpResponseInterface $response)
    {
        $this->httpResponse = $response;
    }

    /**
     * @return HttpResponseInterface
     */
    public function getHttpResponse()
    {
        return $this->httpResponse;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->getData();
    }

    /**
     * @return array
     */
    protected function getData()
    {
        try {
//            switch ($this->getHttpResponse()->getHeader('Content-Type')) {
//                case 'application/xml; charset=utf-8':
//                case 'application/xml':
//                    $data = $this->xml2array($this->getHttpResponse()->xml());
//                    break;
//                case 'application/json; charset=utf-8':
//                case 'application/json':
//                default:
                    $data = $this->getHttpResponse()->json() ?: [];
//                    break;
//            }
        } catch (GuzzleHttpException\ParseException $e) {
            throw new Exception\RuntimeException(
                sprintf('Parse exception requesting \'%s\'', $e->getResponse()->getEffectiveUrl()),
                $e->getCode(),
                $e
            );
        }

        return $data;
    }

    /**
     * @return array
     */
    protected function getIterationData()
    {
        return $this->getData();
    }

//    /**
//     * @todo With this we loose all xml attributes if any and all listings are incorrectly handled (numeric keys)
//     * @param \SimpleXMLElement|array $xmlObject
//     * @param array $out
//     * @return array
//     */
//    private function xml2array($xmlObject, $out = array())
//    {
//        foreach ((array) $xmlObject as $index => $node) {
//            $out[$index] = (is_object($node) || is_array($node)) ? $this->xml2array($node) : $node;
//        }
//
//        return $out;
//    }
}
