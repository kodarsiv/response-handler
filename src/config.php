<?php

return [

    /**
     * If you need to change error or success codes storage you need to change here.
     * available storage services : redis, json, database
     **/
    "STORAGE" => env("RESPONSE_HANDLER_STORAGE", "json"),
    "code_storage" => [
        /**
         * if you want to use json, you need to show path of code jsons.
         * */
        "json" => [
            "storage_path" => [
                "error" => env("RH_ERROR_PATH", storage_path("errors.json")),
                "success" => env("RH_SUCCESS_PATH", storage_path("success.json"))
            ]
        ],

        // .. default connection will be used
        "redis" => [
            "PREFIX" => env("RH_REDIS_PREFIX", "RH_CODES_")
        ],

        // .. default connection will be used
        "database" => [
            // ..
        ]
    ],
    "ERRORS_START_AS" => 500,
    "SUCCESS_START_AS" => 200
];
