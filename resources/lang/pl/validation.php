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
    'accepted'             => ':attribute musi zostaæ zaakceptowany.',
    'active_url'           => ':attribute nie jest poprawnym adresem URL.',
    'after'                => ':attribute musi byæ dat¹ nastêpuj¹c¹ po :date.',
    'after_or_equal'       => ':attribute musi byæ dat¹ nastêpuj¹c¹ b¹dŸ tak¹ sam¹ co :date.',
    'alpha'                => ':attribute mo¿e zawieraæ wy³¹cznie litery.',
    'alpha_dash'           => ':attribute mo¿e zawieraæ wy³¹cznie litery, cyfry b¹dŸ pauzy.',
    'alpha_num'            => ':attribute mo¿e zawieraæ wy³¹cznie litery b¹dŸ cyfry.',
    'array'                => ':attribute musi byæ tablic¹.',
    'before'               => ':attribute musi byæ dat¹ poprzedzaj¹c¹ :date.',
    'before_or_equal'      => ':attribute musi byæ dat¹ równ¹ b¹dŸ poprzedzaj¹c¹ datê :date.',
    'between'              => [
        'numeric' => ':attribute musi byæ zawarty pomiêdzy :min i :max.',
        'file'    => ':attribute musi byæ zawarty pomiêdzy :min i :max KB.',
        'string'  => ':attribute musi zawieraæ od :min do :max znaków.',
        'array'   => ':attribute musi zawieraæ :min and :max wpisów.',
    ],
    'boolean'              => ':attribute musi posiadaæ wartoœæ TRUE b¹dŸ FALSE.',
    'confirmed'            => ':attribute confirmation does not match.',
    'date'                 => ':attribute nie jest poprawn¹ wartoœci¹ typu DATE.',
    'date_format'          => ':attribute nie jest poprawn¹ wartoœci¹ dla formatu :format.',
    'different'            => ':attribute oraz :other nie mog¹ mieæ tej samej wartoœci.',
    'digits'               => ':attribute musi siê sk³adaæ z :digits cyfr.',
    'digits_between'       => ':attribute musi siê sk³adaæ z :min do :max cyfr.',
    'dimensions'           => ':attribute nie posiada poprawnych rozmiarów obrazu.',
    'distinct'             => ':attribute to duplikat.',
    'email'                => ':attribute nie jest poprawnym adresem e-mail.',
    'exists'               => 'Wybrany element :attribute jest nieprawid³owy.',
    'file'                 => ':attribute musi byæ plikiem.',
    'filled'               => ':attribute musi posiadaæ wartoœæ',
    'image'                => ':attribute musi byæ obrazem.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'Pole :attribute nie istnieje w tabeli :other.',
    'integer'              => ':attribute musi byæ prawid³ow¹ wartoœci¹ typu integer.',
    'ip'                   => ':attribute musi byæ prawid³owym adresem IP.',
    'ipv4'                 => ':attribute musi byæ prawid³owym adresem IPv4.',
    'ipv6'                 => ':attribute musi byæ prawid³owym adresem IPv6.',
    'json'                 => ':attribute musi byæ prawid³ow¹ wartoœci¹ string typu JSON.',
    'max'                  => [
        'numeric' => ':attribute nie mo¿e byæ wiêksze od :max.',
        'file'    => 'Plik :attribute nie mo¿e byæ wiêkszy ni¿ :max KB.',
        'string'  => ':attribute nie mo¿e byæ d³u¿szy ni¿ :max znaków.',
        'array'   => 'Tabela :attribute nie mo¿e posiadaæ wiêcej ni¿ :max wpisów.',
    ],
    'mimes'                => ':attribute musi byæ typu :values.',
    'mimetypes'            => ':attribute musi byæ plikiem typu :values.',
    'min'                  => [
        'numeric' => ':attribute musi byæ wiêkszy od :min.',
        'file'    => ':attribute musi byæ wiêkszy ni¿ :min KB.',
        'string'  => ':attribute musi zawieraæ co najmniej :min znaków.',
        'array'   => 'Tabela :attribute musi zawieraæ co najmniej :min rekordów.',
    ],
    'not_in'               => 'Zaznaczony (selected) :attribute jest nieprawid³owy (invalid).',
    'not_regex'            => 'Format :attribute jest niepoprawny.',
    'numeric'              => ':attribute musi siê sk³adaæ z cyfr.',
    'present'              => 'Pole :attribute musi byæ wype³nione.',
    'regex'                => 'Format :attribute jest niepoprawny.',
    'required'             => 'Pole :attribute jest wymagane.',
    'required_if'          => 'Pole :attribute jest wymagane gdy :other ma wartoœæ :value.',
    'required_unless'      => 'Pole :attribute jest wymagane, chyba, ¿e pole :other ma wartoœæ :values.',
    'required_with'        => 'Pole :attribute jest wymagane gdy :values jest wype³nione.',
    'required_with_all'    => 'Pole :attribute jest wymagane gdy :values jest wype³nione.',
    'required_without'     => 'Pole :attribute jest wymagane gdy :values nie jest wype³nione.',
    'required_without_all' => 'Pole :attribute jest wymagane gdy ¿adne z :values nie s¹ wype³nione.',
    'same'                 => ':attribute i :other musz¹ mieæ takie same wartoœci.',
    'size'                 => [
        'numeric' => ':attribute musi mieæ :size cyfr.',
        'file'    => ':attribute musi mieæ :size KB.',
        'string'  => ':attribute musi mieæ :size znaków.',
        'array'   => ':attribute musi mieæ :size rekordów.',
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