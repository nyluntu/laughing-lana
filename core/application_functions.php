<?php

/**
 * Function echo <a>-tag from parameters.
 * @param string $text
 * @param string $controller
 * @param string $action
 * @return string
 */
function linkTo($text, $controller, $action, $id) {
    $html = HtmlTag::createElement();
    $tag = $html->addElement('a')
            ->set('href', BASE_URL . $controller . "?id=" . $id . "&action=" . $action)
            ->setText($text);
    echo $tag;
}

function pagination($lastpage) {
    for ($index = 1; $index <= $lastpage; $index++) {
        $tag .= HtmlTag::createElement('li')
                ->addElement('a')
                ->set('href', BASE_URL . CONTROLLER . "?action=" . ACTION . "&page=" . $index)
                ->setText($index);
    }
    return $tag;
}

?>
