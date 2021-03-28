<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Service;


use App\Model\Rule;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Snowflake\IdGeneratorInterface;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;

class RuleService
{
    /**
     * @Inject
     *
     * @var IdGeneratorInterface
     */
    protected $idGeneratorInterface;

    public function index(int $page, int $pageSize)
    {
        return Rule::query()
            ->forPage($page, $pageSize)
            ->orderByDesc('created_at')
            ->get();
    }

    public function detail(int $id)
    {
        return Rule::query()->findOrFail($id);
    }

    public function create(array $rules)
    {
        return Rule::create([
            'code' => $rules['code'],
            'name' => $rules['name'],
        ]);
    }

    public function update(string $code, array $rules)
    {
    }

    public function delete(int $id)
    {
        return Rule::query()->where('id', $id)->delete();
    }

    /**
     * 检查并且格式化代码
     *
     * @return string
     */
    public function checkAndFormatCode(string $code)
    {
        $parser =  (new ParserFactory)->create(ParserFactory::ONLY_PHP7);

        $ast = $parser->parse($code);
        $traverser = New NodeTraverser;
        $traverser->addVisitor(new NodeVisitor());
        $traverser->traverse($ast);
        $prettyPrinter = new Standard;
        return $prettyPrinter->prettyPrint($ast);
    }
}
