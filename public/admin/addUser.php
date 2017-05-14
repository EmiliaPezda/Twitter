<?php
include_once '../bootstrap.php';

echo "<pre>";




$addComment = new Comment();
$addComment->setUserId(2);
$addComment->setPostId(5);
$addComment->setText('this is second comment');
$addComment->setCreationDate(date('Y-m-d H:i:s'));
print_r($addComment);

$addComment->saveToDB($connection);
