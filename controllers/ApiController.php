<?php
namespace app\controllers;

use app\core\repositories\OrderRepositoryInterface;
use app\core\repositories\ProductRepositoryInterface;
use app\core\services\OrderServiceInterface;
use app\forms\CreateOrderForm;
use app\forms\PayOrderForm;
use Yii;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;

class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    private OrderServiceInterface $orderService;
    private ProductRepositoryInterface $productRepository;
    private OrderRepositoryInterface $orderRepository;

    /**
     * ApiController constructor.
     * @param $id
     * @param $module
     * @param OrderServiceInterface $orderService
     * @param ProductRepositoryInterface $productRepository
     * @param OrderRepositoryInterface $orderRepository
     * @param array $config
     */
    public function __construct(
        $id,
        $module,
        OrderServiceInterface $orderService,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->orderService = $orderService;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionCreateOrder()
    {
        $form = Yii::$container->get(CreateOrderForm::class);

        if ($form->load(Yii::$app->request->bodyParams, '') && $form->validate()) {
            return $this->orderService->create($form->productIds);
        }

        return null;
    }

    public function actionPayOrder()
    {
        $form = Yii::$container->get(PayOrderForm::class);

        if ($form->load(Yii::$app->request->bodyParams, '') && $form->validate())
        {
            return $this->orderService->pay($form->orderId, $form->orderSum);
        }

        return null;
    }

    public function actionGetProducts()
    {
        return $this->productRepository->all();
    }

    public function actionGetOrders()
    {
        return $this->orderRepository->all();
    }

    public function actionGetOrder(int $id)
    {
        return $this->orderRepository->get($id);
    }
}