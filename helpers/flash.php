<?php

namespace Helpers;

/**
 * Create a flash message
 *
 * @param string $name
 * @param string $message
 * @param string $type
 * @return void
 */

class Flash
{

    const FLASH = 'FLASH_MESSAGES';

    const FLASH_ERROR = 'error';
    const FLASH_WARNING = 'warning';
    const FLASH_INFO = 'info';
    const FLASH_SUCCESS = 'success';

    public static function  create_flash_message(string $name, string $message, string $type): void
    {
        // remove existing message with the name
        if (isset($_SESSION[self::FLASH][$name])) {
            unset($_SESSION[self::FLASH][$name]);
        }
        // add the message to the session
        $_SESSION[self::FLASH][$name] = ['message' => $message, 'type' => $type];
        print_r($_SESSION);
    }


    /**
     * Format a flash message
     *
     * @param array $flash_message
     * @return string
     */
    public static function format_flash_message(array $flash_message): string
    {
        // since using bootstrap 5 the type is danger
        if($flash_message['type'] === "error") $flash_message['type'] = "danger";
        return sprintf(
            '<div class="alert alert-%s mb-4">%s</div>',
            $flash_message['type'],
            $flash_message['message']
        );
    }

    /**
     * Display a flash message
     *
     * @param string $name
     * @return void
     */
    public static function display_flash_message(string $name): void
    {
        if (!isset($_SESSION[self::FLASH][$name])) {
            return;
        }

        // get message from the session
        $flash_message = $_SESSION[self::FLASH][$name];

        // delete the flash message
        $_SESSION[self::FLASH][$name] = null;
        unset($_SESSION[self::FLASH][$name]);

        // display the flash message
        echo self::format_flash_message($flash_message);
    }

    /**
     * Display all flash messages
     *
     * @return void
     */
    public static function display_all_flash_messages(): void
    {
        if (!isset($_SESSION[self::FLASH])) {
            return;
        }

        // get flash messages
        $flash_messages = $_SESSION[self::FLASH];

        // print_r($_SESSION);
        // remove all the flash messages
        $_SESSION[self::FLASH]=null;
        unset($_SESSION[self::FLASH]);

        // show all flash messages
        foreach ($flash_messages as $flash_message) {
            echo self::format_flash_message($flash_message);
        }
    }

    /**
     * Flash a message
     *
     * @param string $name
     * @param string $message
     * @param string $type (error, warning, info, success)
     * @return void
     */
    public static function flash(string $name = '', string $message = '', string $type = ''): void
    {
        if ($name !== '' && $message !== '' && $type !== '') {
            // create a flash message
            self::create_flash_message($name, $message, $type);
        } else if ($name !== '' && $message === '' && $type === '') {
            // display a flash message
            self::display_flash_message($name);
        } else if ($name === '' && $message === '' && $type === '') {
            // display all flash message
            self::display_all_flash_messages();
        }
    }

    /**
     * Flash data specified by $keys from the $_SESSION
     * @param ...$keys
     * @return array
     */
    public static function session_flash(...$keys): array
    {
        $data = [];
        foreach ($keys as $key) {
            if (isset($_SESSION[$key])) {
                $data[] = $_SESSION[$key];
                unset($_SESSION[$key]);
            } else {
                $data[] = [];
            }
        }
        return $data;
    }
}
