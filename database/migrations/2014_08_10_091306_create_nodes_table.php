<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nodes', function(Blueprint $table) 
		{
			$table->increments('id');
			$table->string('name')->index();
			$table->string('slug')->nullable()->index();
			$table->smallInteger('parent_node')->nullable()->index();
			$table->text('description')->nullable();
			$table->integer('topic_count')->default(0)->index();
			$table->timestamps();
		});

		$this->initializeNodes();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nodes');
	}

	public function initializeNodes()
	{
		DB::table('nodes')->truncate();
		$node_array = [
			'Maze' => [
				'Naujienos' => [
					'slug' => 'naujienos',
					'description' => 'Karščiausios naujienos iš Maze komandos.',
				],
				'Pasiūlymai' => [
					'slug' => 'pasiulymai',
					'description' => 'Įdėjos ir pasiūlymai Maze platformai.',
				],
				'Klausimai / Atsakymai' => [
					'slug' => 'klausimai-atsakymai',
					'description' => 'Visi klausimai Maze komandai, vienaip ar kitaip susiję su Maze yra laukiami čia.',
				],
			],
			'Counter-Strike: 1.6' => [
				'Bendros Diskusijos' => [
					'slug' => 'counter-strike-diskusijos',
					'description' => 'Bendros Counter-Strike 1.6 diskusijos.',
				],
				'Turgus' => [
					'slug' => 'counter-strike-turgus',
					'description' => 'Pirk, parduok, keisk viską kas susiję su Counter-Strike 1.6.',
				],
				'Serverių Kūrimas' => [
					'slug' => 'counter-strike-serveriu-kurimas',
					'description' => 'Ieškantiems pagalbos ir norintiems pasidalinti savo atradimais Counter-Strike 1.6 serverių kūrime.',
				],
				'Serverių Reklama' => [
					'slug' => 'counter-strike-serveriai',
					'description' => 'Counter-Strike 1.6 serverių reklama yra laukiama čia ir tik čia.',
				],
			],
			'Counter-Strike: GO' => [
				'Bendros Diskusijos' => [
					'slug' => 'counter-strike-go-diskusijos',
					'description' => 'Bendros Counter-Strike: GO diskusijos.',
				],
				'Turgus' => [
					'slug' => 'counter-strike-go-turgus',
					'description' => 'Pirk, parduok, keisk viską kas susiję su Counter-Strike: GO.',
				],
				'Serverių Kūrimas' => [
					'slug' => 'counter-strike-go-serveriu-kurimas',
					'description' => 'Ieškantiems pagalbos ir norintiems pasidalinti savo atradimais Counter-Strike: GO serverių kūrime.',
				],
				'Serverių Reklama' => [
					'slug' => 'counter-strike-go-serveriai',
					'description' => 'Counter-Strike: GO serverių reklama yra laukiama čia ir tik čia.',
				],
			],
			'Counter-Strike: Source' => [
				'Bendros Diskusijos' => [
					'slug' => 'counter-strike-source-diskusijos',
					'description' => 'Bendros Counter-Strike: Source diskusijos. Tinka viskas: 1.6, GO, Source.',
				],
				'Turgus' => [
					'slug' => 'counter-strike-source-turgus',
					'description' => 'Pirk, parduok, keisk viską kas susiję su Counter-Strike: Source.',
				],
				'Serverių Kūrimas' => [
					'slug' => 'counter-strike-source--serveriu-kurimas',
					'description' => 'Ieškantiems pagalbos ir norintiems pasidalinti savo atradimais Counter-Strike: Source serverių kūrime.',
				],
				'Serverių Reklama' => [
					'slug' => 'counter-strike-source-serveriai',
					'description' => 'Counter-Strike: Source serverių reklama yra laukiama čia ir tik čia.',
				],
			],
			'GTA: SA-MP' => [
				'Bendros Diskusijos' => [
					'slug' => 'samp-diskusijos',
					'description' => 'Bendros GTA: SA-MP diskusijos.',
				],
				'Turgus' => [
					'slug' => 'samp-turgus',
					'description' => 'Pirk, parduok, keisk viską kas susiję su GTA: SA-MP.',
				],
				'Serverių Kūrimas' => [
					'slug' => 'samp-kurimas',
					'description' => 'Ieškantiems pagalbos ir norintiems pasidalinti savo atradimais GTA: SA-MP serverių kūrime.',
				],
				'Serverių Reklama' => [
					'slug' => 'samp-serveriai',
					'description' => 'GTA: SA-MP serverių reklama yra laukiama čia ir tik čia.',
				],
			],
			'GTA: MTA' => [
				'Bendros Diskusijos' => [
					'slug' => 'mta-diskusijos',
					'description' => 'Bendros GTA: MTA diskusijos.',
				],
				'Turgus' => [
					'slug' => 'mta-turgus',
					'description' => 'Pirk, parduok, keisk viską kas susiję su GTA: MTA.',
				],
				'Serverių Kūrimas' => [
					'slug' => 'mta-kurimas',
					'description' => 'Ieškantiems pagalbos ir norintiems pasidalinti savo atradimais GTA: MTA serverių kūrime.',
				],
				'Serverių Reklama' => [
					'slug' => 'mta-serveriai',
					'description' => 'GTA: MTA serverių reklama yra laukiama čia ir tik čia.',
				],
			],
			'Minecraft' => [
				'Bendros Diskusijos' => [
					'slug' => 'minecraft-diskusijos',
					'description' => 'Bendros Minecraft diskusijos.',
				],
				'Turgus' => [
					'slug' => 'minecraft-turgus',
					'description' => 'Pirk, parduok, keisk viską kas susiję su Minecraft.',
				],
				'Serverių Kūrimas' => [
					'slug' => 'minecraft-kurimas',
					'description' => 'Ieškantiems pagalbos ir norintiems pasidalinti savo atradimais Minecraft serverių kūrime.',
				],
				'Serverių Reklama' => [
					'slug' => 'minecraft-serveriai',
					'description' => 'Minecraft serverių reklama yra laukiama čia ir tik čia.',
				],
			],
			'RuneScape' => [
				'Bendros Diskusijos' => [
					'slug' => 'runescape-diskusijos',
					'description' => 'Bendros RuneScape diskusijos.',
				],
				'Turgus' => [
					'slug' => 'runescape-turgus',
					'description' => 'Pirk, parduok, keisk viską kas susiję su RuneScape.',
				],
				'Serverių Kūrimas' => [
					'slug' => 'runescape-kurimas',
					'description' => 'Ieškantiems pagalbos ir norintiems pasidalinti savo atradimais RuneScape serverių kūrime.',
				],
				'Serverių Reklama' => [
					'slug' => 'runescape-serveriai',
					'description' => 'RuneScape serverių reklama yra laukiama čia ir tik čia.',
				],
			],
			'League of Legends' => [
				'Bendros Diskusijos' => [
					'slug' => 'lol-diskusijos',
					'description' => 'Bendros League of Legends diskusijos.',
				],
				'Turgus' => [
					'slug' => 'lol-turgus',
					'description' => 'Pirk, parduok, keisk viską kas susiję su League of Legends.',
				],
			],
			'Žaidimų Diskusijos' => [
				'Bendruomenės Žaidimai' => [
					'slug' => 'bendruomenes-zaidimai',
					'description' => 'Esi sukūręs savo žaidimą? Pasidalink juo čia!',
				],
				'Šaudyklės' => [
					'slug' => 'saudykles',
					'description' => 'Pew pew pew. Boom! HEADSHOT.',
				],
				'Strateginiai Žaidimai' => [
					'slug' => 'strateginiai-zaidimai',
					'description' => 'Stronghold, Red Alert, Age of Empires ir panašaus stiliaus žaidimų diskusijos.',
				],
				'Veiksmo Žaidimai' => [
					'slug' => 'veiksmo-zaidimai',
					'description' => 'Veiksmo žaidimų diskusijos.',
				],
				'MMORPG ir MOBA' => [
					'slug' => 'mmorpg-moba',
					'description' => 'Ieškai naujo MMORPG, mėgsti MOBA žanrą? Ši skiltis kaip tik tau.',
				],
				'Lentynių Žaidimai' => [
					'slug' => 'lentyniu-zaidimai',
					'description' => 'BMW ar Audi?',
				],
				'Sporto Žaidimai' => [
					'slug' => 'sporto-zaidimai',
					'description' => 'FIFA, NBA, NFL - visi laukiami čia.',
				],
			],
			'Kompiuteriai ir Konsolės' => [
				'Kompiuterių Pagalba'	=> [
					'slug'	=> 'kompiuteriu-pagalba',
					'description'	=> 'Iškilus bėdai su kompiuteriu kreipkis čia.',
				],
				'Kompiuterių Komponentai'	=> [
					'slug'	=> 'kompiuteriu-komponentai',
					'description'	=> 'Besirenkantiems kompiuterį ar jų komponentus. PC Master Race!',
				],
				'Konsolių Diskusijos'	=> [
					'slug'	=> 'konsoliu-diskusijos',
					'description'	=> 'Konsolių komponentai, patarimai ir klausimai..',
				],

			],
			'Programavimas' => [
				'Tinklapių Kūrimas' => [
					'slug' => 'tinklapiu-kurimas',
					'description' => 'PHP, JavaScript, HTML, CSS, Ruby ir visa kita.',
				],
				'Žaidimų Kūrimas' => [
					'slug' => 'zaidimu-kurimas',
					'description' => 'Žaidimų kūrimas naudojant įvairias technologijas.',
				],
				'Bendra' => [
					'slug' => 'programavimas',
					'description' => 'Bendros programavimo diskusijos skirtos visiems programavimo įpatumams aptarti. Klausimai, atsakymai ir įdomios diskusijos visada laukiamos čia.',
				],
			],
			'Grafika' => [
				'GFX' => [
					'slug' => 'gfx-grafika',
					'description' => 'PHP, JavaScript, HTML, CSS, Ruby ir visa kita.',
				],
				'VFX ir Montažas' => [
					'slug' => 'vfx-montazas',
					'description' => 'Žaidimų kūrimas naudojant įvairias technologijas.',
				],
				'Bendra' => [
					'slug' => 'programavimas',
					'description' => 'Bendros programavimo diskusijos skirtos. Klausimai, atsakymai ir įdomios diskusijos visada laukiamos čia.',
				],
			],
			'Skelbimai' => [
				'Turgus' => [
					'slug' => 'turgus',
					'description' => 'Pirkimai, pardavimai ir keitimai.',
				],
				'Paslaugos' => [
					'slug' => 'paslaugos',
					'description' => 'Teiki paslaugas arba ieškai komandos naujam įdomiam projekto vystymui? Rašyk čia.',
				],
				'Projektų Reklama' => [
					'slug' => 'reklama',
					'description' => 'Sukūrei kažką ir nori pasidalinti tuo su pasauliu? Pirmyn!',
				],
			],
		];

        $top_nodes = array();
        foreach ($node_array as $key => $value) {
            $top_nodes[] = [
                'name' => $key
            ];
        }
        DB::table('nodes')->insert( $top_nodes );

        $nodes = array();
        foreach ($node_array as $key => $value) {
            $top_node = Node::where('name','=',$key)->first();

            foreach ($value as $snode => $svalue) {
                $nodes[] = [
                    'parent_node' => $top_node->id,
                    'name' => $snode,
                    'slug' => $svalue['slug'],
                    'description' => $svalue['description'],
                ];
            }
        }
        DB::table('nodes')->insert( $nodes );
	}

}
