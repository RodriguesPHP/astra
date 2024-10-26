<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Extra
{

    public function validar_csv(string $tipo,string $path){

    }

    public function uploadFile(string $uuid, string $path)
    {
        $tabela = DB::statement("
        CREATE TABLE `$uuid` (
            cpf VARCHAR(14) PRIMARY KEY,
            nome VARCHAR(150) NULL,
            nasc VARCHAR(30) NULL,
            sit INT DEFAULT 0,
            saldo VARCHAR(10) NULL,
            saldo_lib VARCHAR(10) NULL,
            parcelas text NULL,
            idsimulacao varchar(100) NULL,
            log VARCHAR(200) NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL
        )
    ");

        if ($tabela) {
            $loadData = DB::statement("
            LOAD DATA INFILE '$path'
            INTO TABLE `$uuid`
            FIELDS TERMINATED BY ';'
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES
            (cpf, nome, nasc)
        ");

            if ($loadData) {
                return true;
            }
        }

        return false;
    }

}
