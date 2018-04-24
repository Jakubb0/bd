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
    'accepted'             => ':attribute musi zosta� zaakceptowany.',
    'active_url'           => ':attribute nie jest poprawnym adresem URL.',
    'after'                => ':attribute musi by� dat� nast�puj�c� po :date.',
    'after_or_equal'       => ':attribute musi by� dat� nast�puj�c� b�d� tak� sam� co :date.',
    'alpha'                => ':attribute mo�e zawiera� wy��cznie litery.',
    'alpha_dash'           => ':attribute mo�e zawiera� wy��cznie litery, cyfry b�d� pauzy.',
    'alpha_num'            => ':attribute mo�e zawiera� wy��cznie litery b�d� cyfry.',
    'array'                => ':attribute musi by� tablic�.',
    'before'               => ':attribute musi by� dat� poprzedzaj�c� :date.',
    'before_or_equal'      => ':attribute musi by� dat� r�wn� b�d� poprzedzaj�c� dat� :date.',
    'between'              => [
        'numeric' => ':attribute musi by� zawarty pomi�dzy :min i :max.',
        'file'    => ':attribute musi by� zawarty pomi�dzy :min i :max KB.',
        'string'  => ':attribute musi zawiera� od :min do :max znak�w.',
        'array'   => ':attribute musi zawiera� :min and :max wpis�w.',
    ],
    'boolean'              => ':attribute musi posiada� warto�� TRUE b�d� FALSE.',
    'confirmed'            => ':attribute confirmation does not match.',
    'date'                 => ':attribute nie jest poprawn� warto�ci� typu DATE.',
    'date_format'          => ':attribute nie jest poprawn� warto�ci� dla formatu :format.',
    'different'            => ':attribute oraz :other nie mog� mie� tej samej warto�ci.',
    'digits'               => ':attribute musi si� sk�ada� z :digits cyfr.',
    'digits_between'       => ':attribute musi si� sk�ada� z :min do :max cyfr.',
    'dimensions'           => ':attribute nie posiada poprawnych rozmiar�w obrazu.',
    'distinct'             => ':attribute to duplikat.',
    'email'                => ':attribute nie jest poprawnym adresem e-mail.',
    'exists'               => 'Wybrany element :attribute jest nieprawid�owy.',
    'file'                 => ':attribute musi by� plikiem.',
    'filled'               => ':attribute musi posiada� warto��',
    'image'                => ':attribute musi by� obrazem.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'Pole :attribute nie istnieje w tabeli :other.',
    'integer'              => ':attribute musi by� prawid�ow� warto�ci� typu integer.',
    'ip'                   => ':attribute musi by� prawid�owym adresem IP.',
    'ipv4'                 => ':attribute musi by� prawid�owym adresem IPv4.',
    'ipv6'                 => ':attribute musi by� prawid�owym adresem IPv6.',
    'json'                 => ':attribute musi by� prawid�ow� warto�ci� string typu JSON.',
    'max'                  => [
        'numeric' => ':attribute nie mo�e by� wi�ksze od :max.',
        'file'    => 'Plik :attribute nie mo�e by� wi�kszy ni� :max KB.',
        'string'  => ':attribute nie mo�e by� d�u�szy ni� :max znak�w.',
        'array'   => 'Tabela :attribute nie mo�e posiada� wi�cej ni� :max wpis�w.',
    ],
    'mimes'                => ':attribute musi by� typu :values.',
    'mimetypes'            => ':attribute musi by� plikiem typu :values.',
    'min'                  => [
        'numeric' => ':attribute musi by� wi�kszy od :min.',
        'file'    => ':attribute musi by� wi�kszy ni� :min KB.',
        'string'  => ':attribute musi zawiera� co najmniej :min znak�w.',
        'array'   => 'Tabela :attribute musi zawiera� co najmniej :min rekord�w.',
    ],
    'not_in'               => 'Zaznaczony (selected) :attribute jest nieprawid�owy (invalid).',
    'not_regex'            => 'Format :attribute jest niepoprawny.',
    'numeric'              => ':attribute musi si� sk�ada� z cyfr.',
    'present'              => 'Pole :attribute musi by� wype�nione.',
    'regex'                => 'Format :attribute jest niepoprawny.',
    'required'             => 'Pole :attribute jest wymagane.',
    'required_if'          => 'Pole :attribute jest wymagane gdy :other ma warto�� :value.',
    'required_unless'      => 'Pole :attribute jest wymagane, chyba, �e pole :other ma warto�� :values.',
    'required_with'        => 'Pole :attribute jest wymagane gdy :values jest wype�nione.',
    'required_with_all'    => 'Pole :attribute jest wymagane gdy :values jest wype�nione.',
    'required_without'     => 'Pole :attribute jest wymagane gdy :values nie jest wype�nione.',
    'required_without_all' => 'Pole :attribute jest wymagane gdy �adne z :values nie s� wype�nione.',
    'same'                 => ':attribute i :other musz� mie� takie same warto�ci.',
    'size'                 => [
        'numeric' => ':attribute musi mie� :size cyfr.',
        'file'    => ':attribute musi mie� :size KB.',
        'string'  => ':attribute musi mie� :size znak�w.',
        'array'   => ':attribute musi mie� :size rekord�w.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',
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