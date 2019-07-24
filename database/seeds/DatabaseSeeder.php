<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TamanhosSeeder::class);
        $this->call(CursosSeeder::class);
        $this->call(PessoasSeeder::class);
        $this->call(AtletasSeeder::class);
        $this->call(CompeticoesSeeder::class);
        $this->call(ModalidadesSeeder::class);
        $this->call(AssociadosSeeder::class);
        $this->call(AtletaModalidadesSeeder::class);
        $this->call(AtletaCompeticoesSeeder::class);
        $this->call(FornecedoresSeeder::class);
        $this->call(ProdutosSeeder::class);
        $this->call(ServicosSeeder::class);
        $this->call(PagamentosSeeder::class);
        $this->call(ParcelasSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        //$this->call(VendasSeeder::class);
        //$this->call(PedidosSeeder::class);
    }
}
