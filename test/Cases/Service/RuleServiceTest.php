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
namespace HyperfTest\Cases\Service;

use App\Model\Rule;
use App\Service\RuleService;
use Hyperf\Utils\ApplicationContext;
use HyperfTest\HttpTestCase;
use Mockery;

/**
 * @internal
 * @coversNothing
 */
class RuleServiceTest extends HttpTestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testCreate()
    {
        $container = ApplicationContext::getContainer();
        $ruleService = $container->get(RuleService::class);

        $code = uniqid('');
        $result = $ruleService->create([
            'name' => uniqid(''),
            'code' => $code,
            'rules' => [
                [
                    'when' => '$user.age > 10',
                    'then' => <<<'EOF'
<?php
call('var_dump', 10);
EOF,
                ],
                [
                    'when' => '$user.age > 10 && $user.age < 18',
                    'then' => <<<'EOF'
<?php
call('var_dump', '10-18');
EOF,
                ],
                [
                    'when' => '$user.age < 20',
                    'then' => <<<'EOF'
<?php
call('var_dump', '你好啊');
EOF
                ],
            ],
        ]);

        $rules = Rule::where('code', $code)->get();
        $this->assertSame(count($result), $rules->count());
        Rule::query()->where('code', $code)->delete();
    }

    public function testUpdate()
    {
        $container = ApplicationContext::getContainer();
        $ruleService = $container->get(RuleService::class);
        $result = $ruleService->create([
            'name' => '测试修改',
            'code' => 'test_rule',
            'rules' => [
                [
                    'when' => '$user.age > 10',
                    'then' => <<<'EOF'
<?php
call('var_dump', 10);
EOF,
                ],
                [
                    'when' => '$user.age > 10 && $user.age < 18',
                    'then' => <<<'EOF'
<?php
call('var_dump', '10-18');
EOF,
                ],
                [
                    'when' => '$user.age < 20',
                    'then' => <<<'EOF'
<?php
call('var_dump', '你好啊');
EOF
                ],
            ],
        ]);
        $ruleService->update('test_rule', ['code' => 'update_test_rule']);
        $rule = Rule::find($result[0]['id']);
        $this->assertSame($rule->code, 'update_test_rule');
        Rule::query()->where('id', $result->id)->delete();
    }

    public function testDelete()
    {
        $container = ApplicationContext::getContainer();
        $ruleService = $container->get(RuleService::class);
        $result = $ruleService->create([
            'name' => '测试修改',
            'code' => 'test_rule',
            'rules' => [
                [
                    'when' => '$user.age > 10',
                    'then' => <<<'EOF'
<?php
call('var_dump', 10);
EOF,
                ],
                [
                    'when' => '$user.age > 10 && $user.age < 18',
                    'then' => <<<'EOF'
<?php
call('var_dump', '10-18');
EOF,
                ],
                [
                    'when' => '$user.age < 20',
                    'then' => <<<'EOF'
<?php
call('var_dump', '你好啊');
EOF
                ],
            ],
        ]);
        $ruleService->delete('test_rule');
        $rule = Rule::find($result[0]['id']);
        $this->assertNull($rule);
    }

    public function testCheckCode()
    {
        $container = ApplicationContext::getContainer();
        $ruleService = $container->get(RuleService::class);
        $code = <<<'EOL'
<?php
call('var_dump',1,2,3);$i = 0;$i++;
EOL;
        $ruleService->checkAndFormatCode($code);
    }
}
