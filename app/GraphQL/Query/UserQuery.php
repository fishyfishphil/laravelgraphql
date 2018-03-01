<?php

namespace App\GraphQL\Query;

use App\User;
use Folklore\GraphQL\Support\Query;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

/**
 * Class UserQuery
 * @package App\GraphQL\Query
 */
class UserQuery extends Query
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'UserQuery',
        'description' => 'A User query',
    ];

    /**
     * @return null
     */
    public function type()
    {
        return GraphQL::type('User'); //If error put: UserType
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @param $context
     * @param ResolveInfo $info
     * @return mixed
     */
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        return User::find($args['id']);
    }
}