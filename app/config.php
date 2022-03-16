<?php
return [
    "views_path"    =>  "../app/Views/",
    "mail"  =>  [
        "smtp"  =>  "smtp.gmail.com",
        "port"  =>  587,
        "encryption"    =>  "tls",
        "email" =>  "example@gmail.com",
        "password"  =>  ""
    ],
    "database"  =>  [
        "driver"    =>  "mysql",
        "host"  =>  "localhost",
        "database_name" =>  "blog",
        "username"  =>  "root",
        "password"  =>  ""
    ],
    'uploadsFolder' =>  'uploads/'
];