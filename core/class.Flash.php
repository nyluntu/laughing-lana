<?php

/**
 * Flash messages
 *
 * @author Turo Nylund
 */
class Flash {

    public static $messages;

    public static function init() {
// Create the session array if it doesnt already exist
        if (!array_key_exists('flash_messages', $_SESSION)) {
            $_SESSION['flash_messages'] = array();
        }
    }

    public static function add($message) {
        $_SESSION['flash_messages'] = $message;
    }

    public static function display() {
        self::$messages = $_SESSION['flash_messages'];
        $_SESSION['flash_messages'] = array();
        return self::$messages;
    }

}
?>
