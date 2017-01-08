<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagesExistTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPagesExist()
    {
        $this->visit('/')->assertResponseOk();
        $this->visit('/dppa/program/')->assertResponseOk();
        $this->visit('/dppa/program/import')->assertResponseOk();
        $this->visit('/dppa/program/export')->assertResponseOk();
        $this->visit("/dppa/program/create")->assertResponseOk();
        $program = \App\DPPA\Program::all();
        $program->each(function($program){
            $this->visit("/dppa/program/{$program->kode}")->assertResponseOk();
            $this->visit("/dppa/program/{$program->kode}/edit")->assertResponseOk();
            $kegiatan = $program->kegiatan;
            $kegiatan->each(function($kegiatan) use($program){
                $this->visit("/dppa/program/$program->kode/kegiatan_id/$kegiatan->kode")->assertResponseOk();
                $this->visit("/dppa/program/$program->kode/kegiatan_id/$kegiatan->kode/edit")->assertResponseOk();
                $this->visit("/dppa/program/$program->kode/kegiatan_id/create")->assertResponseOk();
                $this->visit("/dppa/program/$program->kode/kegiatan_id/$kegiatan->kode/subkegiatan/create")->assertResponseOk();
                $sub_kegiatan = $kegiatan->sub_kegiatan;
                $sub_kegiatan->each(function($sub_kegiatan){

                });
            });
        });
    }
}
