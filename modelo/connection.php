<?php
class Connection
{
    const hostname = "localhost";
    const username = "localhost";
    const password = "";
    const database = "bookexchange";

    static public function getConnection()
    {
        return new mysqli(self::hostname, self::username, self::password, self::database);
    }
}
