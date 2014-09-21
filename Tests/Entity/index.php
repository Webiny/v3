<?php

include 'setup.php';

die("INDEX");
/**
 * ENTITY
 */
/*$page = new PageEntity();

$page->title = 'New title';

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

die($page->getId()->getValue());*/
/**
 * ARCHIVER
 */
$pageId = '53e1c8b96803fa01188b45e8';

/*$page = PageEntity::findById($pageId);

$page->delete();*/

/*$restoredEntity = PageEntity::restore($pageId);

print_r($restoredEntity->toArray('*,comments,labels', 5));*/