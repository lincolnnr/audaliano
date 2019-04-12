<?php

namespace SONFin\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable =[
        razaosocial,
        nomefantasia,
        cnpj,
        inscricaoestadual,
        inscricaomunicipal,
        telefone,
        email,
        cep,
        logradouro,
        numero,
        complemento,
        bairro,
        cidade,
        estado,
    ];
}