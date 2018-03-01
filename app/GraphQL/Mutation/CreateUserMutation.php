<?php

namespace App\GraphQL\Mutation;

use App\User;
use Folklore\GraphQL\Support\Mutation;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

/**
 * Class CreateUserMutation
 * @package App\GraphQL\Mutation
 */
class CreateUserMutation extends Mutation
{
    /**
     * @var array
     */
    protected $attributes = [
        'name' => 'CreateUserMutation',
        'description' => 'A mutation to create User',
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
            'name' => [
                'type' => Type::nonNull(Type::string()),
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['email', 'unique:users'],
            ],
            'password' => [
                'type' => Type::nonNull(Type::string()),
                'rules' => ['min:4'],
            ],
        ];
    }

    /**
     * @param $root
     * @param $args
     * @param $context
     * @param ResolveInfo $info
     * @return User
     */
    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $user = new User();
        $user->fill($args);
        $user->save();
        return $user;
    }
}