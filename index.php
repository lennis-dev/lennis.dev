<?php

function renderfile(string $file): string
{
    $content = file_get_contents($file);
    $master = file_get_contents(__DIR__ . "/pages/_master.html");
    $master = str_replace("[content]", $content, $master);
    return $master;
}
if ($_SERVER["REQUEST_URI"] == "/") {
    echo renderfile(__DIR__ . "/pages/_index.html");
    exit();
} else if ($_SERVER["REQUEST_URI"] == "/sendmail") {
    header("Location: mailto:x@lennis.dev");
    exit;
} else {
    $realpath = realpath(__DIR__ . "/pages/" . explode("/", $_SERVER["REQUEST_URI"])[1] . ".html");
    if (str_starts_with($realpath, __DIR__ . "/pages/")) {
        if (file_exists($realpath)) {
            echo renderfile($realpath);
            exit();
        }
    }
}
echo renderfile(__DIR__ . "/pages/_404.html");
