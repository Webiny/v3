<?php

use WebinyPlatform\Tests\Entity\MyClasses\Comment;
use WebinyPlatform\Tests\Entity\MyClasses\Page;

include 'setup.php';

$test = new Page();
$test->title = 123;
$test->save();

die(print_r($test->toArray()));

/**
 * ENTITY
 */
/*$page = new Page();
$data = [
    'title'    => 'attribute',
    'comments' => [
        ['id' => '543c0fb76803fa76058b4569'],
        ['id' => '543c0fda6803fa76058b456f']
    ]
];
try {
    $page->populate($data);
} catch (\Webiny\Component\Entity\EntityException $e) {
    foreach ($e->getInvalidAttributes() as $key => $error) {
        echo $key . ": " . $error->getMessage() . "<br>";
    }
    die();
}

$page->save();

die(print_r($page->toArray('*,comments.*', 1)));*/


/*$page->title = 'New title';

$label = new LabelEntity();
$label->label = 'marketing';

$page->labels->add($label);

$author = new AuthorEntity();
$author->name = 'Pavel';

$comment = new CommentEntity();
$comment->text = 'First comment';
$comment->author = $author;
$page->comments->add($comment);

$page->save();

die($page->getId()->getValue());
*/
