<?php

declare(strict_types=1);

namespace Rebing\GraphQL\Tests\Support\Objects;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateExampleMutation extends Mutation
{
    /**
     * @var array<string,string>
     */
    protected $attributes = [
        'name' => 'updateExample',
    ];

    public function type(): Type
    {
        return GraphQL::type('Example');
    }

    protected function rules(array $args = []): array
    {
        return [
            'test' => ['required'],
        ];
    }

    public function args(): array
    {
        return [
            'test' => [
                'name' => 'test',
                'type' => Type::string(),
            ],

            'test_with_rules' => [
                'name' => 'test',
                'type' => Type::string(),
                'rules' => ['required'],
            ],

            'test_with_rules_closure' => [
                'name' => 'test',
                'type' => Type::string(),
                'rules' => function () {
                    return ['required'];
                },
            ],
        ];
    }

    /**
     * @param mixed $root
     * @param array<string,mixed> $args
     * @param mixed $context
     * @param ResolveInfo $resolveInfo
     * @param Closure $getSelectFields
     * @return array<string,mixed>
     */
    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): array
    {
        return [
            'test' => $args['test'],
        ];
    }
}
