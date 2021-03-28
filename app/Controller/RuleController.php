<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\RuleCreateReqeust;
use App\Request\RuleIndexRequest;
use App\Request\RuleUpdateRequest;
use App\Service\RuleService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

/**
 * @Controller
 */
class RuleController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @Inject
     * @var RuleService
     */
    protected $ruleService;

    /**
     * @PostMapping(path="/rules/queries")
     */
    public function index(RuleIndexRequest $request)
    {
        $page = $request->post('page', 1);
        $pageSize = $request->post('page_size', 10);
        $result = $this->ruleService->index($page, $pageSize);
        return $this->success(['current' => $result, 'list' => $result]);
    }

    /**
     * @GetMapping(path="/rule/{id}")
     */
    public function detail()
    {
        $id = $this->request->route('id');
        $result = $this->ruleService->detail((int) $id);
        return $this->success($result);
    }

    /**
     * @PostMapping(path="/rule")
     */
    public function create(RuleCreateReqeust $request)
    {
        $result = $this->ruleService->create($request->validated());
        return $this->success($result);
    }

    /**
     * @PutMapping(path="/rule/{id}")
     */
    public function update(RuleUpdateRequest $request)
    {
        $id = $this->request->route('id');
        $this->ruleService->update((int) $id, $request->validated());
        return $this->success([]);
    }

    /**
     * @DeleteMapping(path="/rule/{id}")
     */
    public function delete()
    {
        $id = $this->request->route('id');
        $this->ruleService->delete((int) $id);
        return $this->success([]);
    }

    /**
     * @PostMapping(path="/rule/check/{code}")
     */
    public function checkCode()
    {
        $this->ruleService->checkCode();
    }

    /**
     * @PostMapping(path="/rule/execute/{code}")
     */
    public function execute()
    {

    }

    public function error($data)
    {
        $jsonBody = [
            'code' => 2000,
            'message' => 'error',
            'data' => $data
        ];
        return $this->response->json($jsonBody);
    }

    public function success($data)
    {
        $jsonBody = [
            'code' => 1000,
            'message' => 'success',
            'data' => $data
        ];
        return $this->response->json($jsonBody);
    }
}
