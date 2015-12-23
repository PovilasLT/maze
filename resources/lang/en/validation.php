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
	"active_url"           => ":attribute nėra tinkamas URL.",
	"after"                => ":attribute privalo būti vėlesnė datai nei :date.",
	"alpha"                => ":attribute gali sudaryti tik raidės.",
	"alpha_dash"           => ":attribute gali sudaryti tik raidės, skaičiai ir brukšnys.",
	"alpha_num"            => ":attribute gali sudaryti tik raidės ir skaičiai.",
	"array"                => ":attribute turi būti masyvas.",
	"before"               => ":attribute privalo būti ankstesnė datai nei :date.",
	"between"              => [
		"numeric" => ":attribute turi būti didesnis už :min ir mažesnis už :max.",
		"file"    => ":attribute turi būti didesnis nei :min ir mažesnis nei :max kilobaitai.",
		"string"  => ":attribute turi sudaryti nuo :min iki :max simbolių.",
		"array"   => ":attribute turi sudaryti nuo :min iki :max elementų.",
	],
	"boolean"              => ":attribute laukelis turi būti \"true\" arba \"false\".",
	"confirmed"            => ":attribute patvirtinimas nesutampa.",
	"date"                 => ":attribute nėra data.",
	"date_format"          => ":attribute neatitinka formato :format.",
	"different"            => ":attribute ir :other turi būti skirtingi.",
	"digits"               => ":attribute turi sudaryti :digits skaičiai.",
	"digits_between"       => ":attribute turi sudaryti nuo :min iki :max skaičių.",
	"email"                => ":attribute turi būti teisingas el. pašto adresas.",
	"filled"               => ":attribute yra privalomas.",
	"exists"               => "Pasirinktas :attribute yra netinkamas.",
	"image"                => ":attribute turi būti paveikslėlis.",
	"in"                   => "pasirinktas :attribute yra netinkamas.",
	"integer"              => ":attribute turi būti sveikasis skaičius.",
	"ip"                   => ":attribute turi būti IP adresas.",
	"max"                  => [
		"numeric" => ":attribute negali būti didesnis už :max.",
		"file"    => ":attribute negali būti didesnis nei :max kilobaitai.",
		"string"  => ":attribute negali sudaryti daugiau nei :max simbolių.",
		"array"   => ":attribute negali sudaryti daugiau nei :max elementų.",
	],
	"mimes"                => ":attribute leidžiami plėtiniai: :values.",
	"min"                  => [
		"numeric" => ":attribute turi būti ne mažesnis nei :min.",
		"file"    => ":attribute turi būti ne mažesnis nei :min kilobaitai..",
		"string"  => ":attribute turi sudaryti ne mažiau nei :min simboliai.",
		"array"   => ":attribute turi sudaryti ne mažiau nei :min elementai.",
	],
	"not_in"               => "Pasirinktas :attribute yra netinkamas.",
	"numeric"              => ":attribute turi būti skaičius.",
	"regex"                => ":attribute formatas yra netinkamas.",
	"required"             => ":attribute yra privalomas.",
	"required_if"          => ":attribute yra privalomas kai :other yra :value.",
	"required_with"        => ":attribute yra privalomas kai :values.",
	"required_with_all"    => ":attribute yra privalomas kai :values.",
	"required_without"     => ":attribute yra privalomas kai :values nėra.",
	"required_without_all" => ":attribute yra privalomas kai nei viena iš reikšmių :values nenurodyta.",
	"same"                 => ":attribute ir :other turi sutapti.",
	"size"                 => [
		"numeric" => ":attribute turi būti :size.",
		"file"    => ":attribute turi būti :size kilobaitai.",
		"string"  => ":attribute turi sudaryti :size simbolių(ai).",
		"array"   => ":attribute turi sudaryti :size elementų(ai).",
	],
	"unique"               => ":attribute jau naudojamas.",
	"url"                  => ":attribute formatas netinkamas.",
	"timezone"             => ":attribute turi būti laiko juosta.",

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
