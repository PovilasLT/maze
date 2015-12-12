<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "The :attribute must be accepted.",
	"active_url"           => ":attribute nëra tinkamas URL.",
	"after"                => ":attribute privalo bûti vëlesnë datai nei :date.",
	"alpha"                => ":attribute gali sudaryti tik raidës.",
	"alpha_dash"           => ":attribute gali sudaryti tik raidës, skaièiai ir brukðnys.",
	"alpha_num"            => ":attribute gali sudaryti tik raidës ir skaièiai.",
	"array"                => ":attribute turi bûti masyvas.",
	"before"               => ":attribute privalo bûti ankstesnë datai nei :date.",
	"between"              => [
		"numeric" => ":attribute turi bûti didesnis uþ :min ir maþesnis uþ :max.",
		"file"    => ":attribute turi bûti didesnis nei :min ir maþesnis nei :max kilobaitai.",
		"string"  => ":attribute turi sudaryti nuo :min iki :max simboliø.",
		"array"   => ":attribute turi sudaryti nuo :min iki :max elementø.",
	],
	"boolean"              => ":attribute laukelis turi bûti \"true\" arba \"false\".",
	"confirmed"            => ":attribute patvirtinimas nesutampa.",
	"date"                 => ":attribute nëra data.",
	"date_format"          => ":attribute neatitinka formato :format.",
	"different"            => ":attribute ir :other turi bûti skirtingi.",
	"digits"               => ":attribute turi sudaryti :digits skaièiai.",
	"digits_between"       => ":attribute turi sudaryti nuo :min iki :max skaièiø.",
	"email"                => ":attribute turi bûti teisingas el. paðto adresas.",
	"filled"               => ":attribute yra privalomas.",
	"exists"               => "Pasirinktas :attribute yra netinkamas.",
	"image"                => ":attribute turi bûti paveikslëlis.",
	"in"                   => "pasirinktas :attribute yra netinkamas.",
	"integer"              => ":attribute turi bûti sveikasis skaièius.",
	"ip"                   => ":attribute turi bûti IP adresas.",
	"max"                  => [
		"numeric" => ":attribute negali bûti didesnis uþ :max.",
		"file"    => ":attribute negali bûti didesnis nei :max kilobaitai.",
		"string"  => ":attribute negali sudaryti daugiau nei :max simboliø.",
		"array"   => ":attribute negali sudaryti daugiau nei :max elementø.",
	],
	"mimes"                => ":attribute leidþiami plëtiniai: :values.",
	"min"                  => [
		"numeric" => ":attribute turi bûti ne maþesnis nei :min.",
		"file"    => ":attribute turi bûti ne maþesnis nei :min kilobaitai..",
		"string"  => ":attribute turi sudaryti ne maþiau nei :min simboliai.",
		"array"   => ":attribute turi sudaryti ne maþiau nei :min elementai.",
	],
	"not_in"               => "Pasirinktas :attribute yra netinkamas.",
	"numeric"              => ":attribute turi bûti skaièius.",
	"regex"                => ":attribute formatas yra netinkamas.",
	"required"             => ":attribute yra privalomas.",
	"required_if"          => ":attribute yra privalomas kai :other yra :value.",
	"required_with"        => ":attribute yra privalomas kai :values.",
	"required_with_all"    => ":attribute yra privalomas kai :values.",
	"required_without"     => ":attribute yra privalomas kai :values nëra.",
	"required_without_all" => ":attribute yra privalomas kai nei viena ið reikðmiø :values nenurodyta.",
	"same"                 => ":attribute ir :other turi sutapti.",
	"size"                 => [
		"numeric" => ":attribute turi bûti :size.",
		"file"    => ":attribute turi bûti :size kilobaitai.",
		"string"  => ":attribute turi sudaryti :size simboliø(ai).",
		"array"   => ":attribute turi sudaryti :size elementø(ai).",
	],
	"unique"               => ":attribute jau naudojamas.",
	"url"                  => ":attribute formatas netinkamas.",
	"timezone"             => ":attribute turi bûti laiko juosta.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [],

];
