<?php
namespace BlogTest;

/*
 * This file is a part of GraphQL project.
 *
 * @author Alexandr Viniychuk <a@viniychuk.com>
 * created: 8:21 PM 4/28/16
 */

use Youshido\GraphQL\Processor;
use Youshido\GraphQL\Schema;
use Youshido\GraphQL\Type\Object\ObjectType;
use Youshido\GraphQL\Validator\ResolveValidator\ResolveValidator;

require_once __DIR__ . '/../../vendor/autoload.php';
$rootQueryType = new ObjectType([
    'name' => 'RootQueryType',
]);

function resolvePost()
{
    return [
        "title"   => "Interesting approach",
        "summary" => "This new GraphQL library for PHP works really well",
    ];
}

require_once __DIR__ . '/structures/object-inline.php';

$processor = new Processor(new ResolveValidator());
$processor->setSchema(new Schema([
    'query' => $rootQueryType
]));

$res = $processor->processRequest('{ latestPost { title, summary } }')->getResponseData();
echo json_encode($res);
echo "\n\n";