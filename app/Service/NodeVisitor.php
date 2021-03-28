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

use App\Exception\InvalidFunctionException;
use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use PhpParser\NodeVisitorAbstract;
use PHPStan\Node\Method\MethodCall;

class NodeVisitor extends NodeVisitorAbstract
{
    public function enterNode(Node $node)
    {
        if ($node instanceof FuncCall || $node instanceof ClassMethod || $node instanceof Function_ || $node instanceof MethodCall) {
            if (! in_array($node->name, config('function_white_list', []))) {
                throw new InvalidFunctionException($node->name . ' function is invalid.');
            }
        }
    }
}
