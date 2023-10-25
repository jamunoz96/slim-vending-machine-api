<?php

namespace App\Controllers;

use App\Models\Product;
use Psr\Log\LoggerInterface;
use Slim\Exception\NotFoundException;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProductsController extends DefaultController
{
    /**
     *
     * @var $logger
     */
    private $logger;

    /**
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Get All Products
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response) : Response
    {
        try {
            $products = Product::all();
            // sleep(2);
        } catch (\PDOException $exception) {
            $this->logger->error($exception);
            return $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        } catch (\Throwable $th) {
            $this->logger->error($th);
            return $response->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }

        return $this->jsonResponse($response, [
            'success' => true,
            'data' => $products
        ], StatusCodeInterface::STATUS_OK);
    }


    /**
     * Update Product
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function update(Request $request, Response $response) : Response
    {
        sleep(3);
        $id = $request->getAttribute('id');

        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $ModelNotFoundException) {
            $this->logger->error($ModelNotFoundException);
            return $response->withStatus(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        $product->unity = $product->unity - 1;

        if (!$product->save()) {
            $this->logger->error(
                'An error encountered while updating.',
                ['id' => $id]
            );
            return $reponse->withStatus(StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }

        return $this->jsonResponse($response, [
            'success' => true,
            'message' => 'Product successfully updated.',
            'data' => Product::all()
        ], StatusCodeInterface::STATUS_OK);
    }

}
