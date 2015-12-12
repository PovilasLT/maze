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
	"active_url"           => ":attribute n�ra tinkamas URL.",
	"after"                => ":attribute privalo b�ti v�lesn� datai nei :date.",
	"alpha"                => ":attribute gali sudaryti tik raid�s.",
	"alpha_dash"           => ":attribute gali sudaryti tik raid�s, skai�iai ir bruk�nys.",
	"alpha_num"            => ":attribute gali sudaryti tik raid�s ir skai�iai.",
	"array"                => ":attribute turi b�ti masyvas.",
	"before"               => ":attribute privalo b�ti ankstesn� datai nei :date.",
	"between"              => [
		"numeric" => ":attribute turi b�ti didesnis u� :min ir ma�esnis u� :max.",
		"file"    => ":attribute turi b�ti didesnis nei :min ir ma�esnis nei :max kilobaitai.",
		"string"  => ":attribute turi sudaryti nuo :min iki :max simboli�.",
		"array"   => ":attribute turi sudaryti nuo :min iki :max element�.",
	],
	"boolean"              => ":attribute laukelis turi b�ti \"true\" arba \"false\".",
	"confirmed"            => ":attribute patvirtinimas nesutampa.",
	"date"                 => ":attribute n�ra data.",
	"date_format"          => ":attribute neatitinka formato :format.",
	"different"            => ":attribute ir :other turi b�ti skirtingi.",
	"digits"               => ":attribute turi sudaryti :digits skai�iai.",
	"digits_between"       => ":attribute turi sudaryti nuo :min iki :max skai�i�.",
	"email"                => ":attribute turi b�ti teisingas el. pa�to adresas.",
	"filled"               => ":attribute yra privalomas.",
	"exists"               => "Pasirinktas :attribute yra netinkamas.",
	"image"                => ":attribute turi b�ti paveiksl�lis.",
	"in"                   => "pasirinktas :attribute yra netinkamas.",
	"integer"              => ":attribute turi b�ti sveikasis skai�ius.",
	"ip"                   => ":attribute turi b�ti IP adresas.",
	"max"                  => [
		"numeric" => ":attribute negali b�ti didesnis u� :max.",
		"file"    => ":attribute negali b�ti didesnis nei :max kilobaitai.",
		"string"  => ":attribute negali sudaryti daugiau nei :max simboli�.",
		"array"   => ":attribute negali sudaryti daugiau nei :max element�.",
	],
	"mimes"                => ":attribute leid�iami pl�tiniai: :values.",
	"min"                  => [
		"numeric" => ":attribute turi b�ti ne ma�esnis nei :min.",
		"file"    => ":attribute turi b�ti ne ma�esnis nei :min kilobaitai..",
		"string"  => ":attribute turi sudaryti ne ma�iau nei :min simboliai.",
		"array"   => ":attribute turi sudaryti ne ma�iau nei :min elementai.",
	],
	"not_in"               => "Pasirinktas :attribute yra netinkamas.",
	"numeric"              => ":attribute turi b�ti skai�ius.",
	"regex"                => ":attribute formatas yra netinkamas.",
	"required"             => ":attribute yra privalomas.",
	"required_if"          => ":attribute yra privalomas kai :other yra :value.",
	"required_with"        => ":attribute yra privalomas kai :values.",
	"required_with_all"    => ":attribute yra privalomas kai :values.",
	"required_without"     => ":attribute yra privalomas kai :values n�ra.",
	"required_without_all" => ":attribute yra privalomas kai nei viena i� reik�mi� :values nenurodyta.",
	"same"                 => ":attribute ir :other turi sutapti.",
	"size"                 => [
		"numeric" => ":attribute turi b�ti :size.",
		"file"    => ":attribute turi b�ti :size kilobaitai.",
		"string"  => ":attribute turi sudaryti :size simboli�(ai).",
		"array"   => ":attribute turi sudaryti :size element�(ai).",
	],
	"unique"               => ":attribute jau naudojamas.",
	"url"                  => ":attribute formatas netinkamas.",
	"timezone"             => ":attribute turi b�ti laiko juosta.",

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
