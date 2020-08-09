<?php
require_once 'classes/Post.php';
$posts = Post::getDOM();
echo "<!doctype html><html><head></head><body><textarea rows='100' cols='160'>". $posts->saveXML() ."</textarea></body></html>";