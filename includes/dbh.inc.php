<?php
class Connection
{
    const hostname = "localhost";
    const username = "localhost";
    const password = "";
    const database = "bookexchange";

    public static function getConnection()
    {
        return new mysqli(
            self::hostname,
            self::username,
            self::password,
            self::database
        );
    }
}
