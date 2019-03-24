<?php

namespace OP\Services\Response;

use Ep\Util\HasResourceCollection;
use Illuminate\Contracts\Support\Responsable;
use League\Fractal\Manager;
use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use PhpCsFixer\Tokenizer\AbstractTransformer;

class ApiResponse implements Responsable
{
    private $statusCode = 200;
    private $data = [];
    private $message = 'Request successfully processed';
    private $status = 'success';

    public function success(array $data = [])
    {
        $this->data = $data;
        $this->statusCode = 200;
    }

    public function fail($message = '', $data = [])
    {
        if (!empty($data)) {
            $this->data = $data;
        }

        if (!empty($message)) {
            $this->message = $message;
        }


        $this->statusCode = 400;
        $this->status = 'fail';
        $this->setMessage($message);
    }

    public function setStatusCode($code)
    {
        $this->statusCode = $code;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function authenticationFailed()
    {
        $this->data = [];

        $this->setStatusCode(403);
    }


    public function getStatusCode()
    {
        return $this->statusCode;
    }


    public function getMessage()
    {
        return $this->message;
    }

    public function unAuthorized()
    {
        $this->data = [];

        $this->message = "You dont have permission to perform this action";
        $this->setStatusCode(403);
    }

    public function unProcessableEntity()
    {
        $this->data = [];

        $this->message = "Couldnt process the current data";
        $this->setStatusCode(403);
    }

    public function toResponse($request)
    {
        $data = [
            'message' => $this->message,
            'status' => $this->status,
        ];

        return response(array_merge($data, ['data' => $this->data]), $this->statusCode);
    }

    public function respondWithCollection(HasResourceCollection $collection, $transformer, PaginatorInterface $paginator = null)
    {
        $manager = new Manager();
        $resource = new Collection($collection->get(), $transformer);

        if ($paginator) {
            $resource->setPaginator($paginator);
        }

        return $manager->createData($resource)->toJson();
    }

    public function respondWithItem($item, $transformer)
    {
        $manager = new Manager();
        $resource = new Item($item, $transformer);

        return $manager->createData($resource)->toJson();
    }


}
