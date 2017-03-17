<?php

/*
* 针对 config/database.php 文件，来为不同环境的数据库连接方式定义一个帮助方法,
* 以便根据应用不同的运行环境来指定数据库配置信息。
*/
function get_db_config()
{
    /*
    * IS_IN_HEROKU Heroku 环境
    */
    if (getenv('IS_IN_HEROKU')) {
        $url = parse_url(getenv("DATABASE_URL"));

        return $db_config = [
            'connetion' => 'pgsql',
            'host' => $url["host"],
            'database'  => substr($url["path"], 1),
            'username'  => $url["user"],
            'password'  => $url["pass"],
        ];
    } else {
        return $db_config = [
            'connetion' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'forge'),
            'username'  => env('DB_USERNAME', 'forge'),
            'password'  => env('DB_PASSWORD', ''),
        ];
    }
}
