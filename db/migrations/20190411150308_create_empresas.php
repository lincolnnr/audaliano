<?php

use Phinx\Migration\AbstractMigration;

class CreateEmpresas extends AbstractMigration
{
    public function up()
    {
        $this->table('empresas')
            ->addColumn('razaosocial', 'string')
            ->addColumn('nomefantasia', 'string')
            ->addColumn('cnpj', 'string')
            ->addColumn('inscricaoestadual', 'string')
            ->addColumn('inscricaomunicipal', 'string')
            ->addColumn('telefone', 'string')
            ->addColumn('email', 'string')
            ->addColumn('cep', 'string')
            ->addColumn('logradouro', 'string')
            ->addColumn('numero', 'string')
            ->addColumn('complemento', 'string')
            ->addColumn('bairro', 'string')
            ->addColumn('cidade', 'string')
            ->addColumn('estado', 'string')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addIndex(['cnpj'],['unique' => true])
            ->save();
    }

    public function down()
    {
        $this->dropTable('empresas');
    }
}