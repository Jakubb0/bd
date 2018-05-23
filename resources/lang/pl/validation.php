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
    'accepted'             => ':attribute musi zostać zaakceptowany.',
    'active_url'           => ':attribute nie jest poprawnym adresem URL.',
    'after'                => ':attribute musi być datą następującą po :date.',
    'after_or_equal'       => ':attribute musi być datą następującą bądź taką samą co :date.',
    'alpha'                => ':attribute może zawierać wyłącznie litery.',
    'alpha_dash'           => ':attribute może zawierać wyłącznie litery, cyfry bądź pauzy.',
    'alpha_num'            => ':attribute może zawierać wyłącznie litery bądź cyfry.',
    'array'                => ':attribute musi być tablicą.',
    'before'               => ':attribute musi być datą poprzedzającą :date.',
    'before_or_equal'      => ':attribute musi być datą równą bądź poprzedzającą datę :date.',
    'between'              => [
        'numeric' => ':attribute musi być zawarty pomiędzy :min i :max.',
        'file'    => ':attribute musi być zawarty pomiędzy :min i :max KB.',
        'string'  => ':attribute musi zawierać od :min do :max znaków.',
        'array'   => ':attribute musi zawierać :min and :max wpisów.',
    ],
    'boolean'              => ':attribute musi posiadać wartość TRUE bądź FALSE.',
    'confirmed'            => ':attribute confirmation does not match.',
    'date'                 => ':attribute nie jest poprawną wartością typu DATE.',
    'date_format'          => ':attribute nie jest poprawną wartością dla formatu :format.',
    'different'            => ':attribute oraz :other nie mogą mieć tej samej wartości.',
    'digits'               => ':attribute musi się składać z :digits cyfr.',
    'digits_between'       => ':attribute musi się składać z :min do :max cyfr.',
    'dimensions'           => ':attribute nie posiada poprawnych rozmiarów obrazu.',
    'distinct'             => ':attribute to duplikat.',
    'email'                => ':attribute nie jest poprawnym adresem e-mail.',
    'exists'               => 'Wybrany element :attribute jest nieprawidłowy.',
    'file'                 => ':attribute musi być plikiem.',
    'filled'               => ':attribute musi posiadać wartość',
    'image'                => ':attribute musi być obrazem.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'Pole :attribute nie istnieje w tabeli :other.',
    'integer'              => ':attribute musi być prawidłową wartością typu integer.',
    'ip'                   => ':attribute musi być prawidłowym adresem IP.',
    'ipv4'                 => ':attribute musi być prawidłowym adresem IPv4.',
    'ipv6'                 => ':attribute musi być prawidłowym adresem IPv6.',
    'json'                 => ':attribute musi być prawidłową wartością string typu JSON.',
    'max'                  => [
        'numeric' => ':attribute nie może być większe od :max.',
        'file'    => 'Plik :attribute nie może być większy niż :max KB.',
        'string'  => ':attribute nie może być dłuższy niż :max znaków.',
        'array'   => 'Tabela :attribute nie może posiadać więcej niż :max wpisów.',
    ],
    'mimes'                => ':attribute musi być typu :values.',
    'mimetypes'            => ':attribute musi być plikiem typu :values.',
    'min'                  => [
        'numeric' => ':attribute musi być większy od :min.',
        'file'    => ':attribute musi być większy niż :min KB.',
        'string'  => ':attribute musi zawierać co najmniej :min znaków.',
        'array'   => 'Tabela :attribute musi zawierać co najmniej :min rekordów.',
    ],
    'not_in'               => 'Zaznaczony (selected) :attribute jest nieprawidłowy (invalid).',
    'not_regex'            => 'Format :attribute jest niepoprawny.',
    'numeric'              => ':attribute musi się składać z cyfr.',
    'present'              => 'Pole :attribute musi być wypełnione.',
    'regex'                => 'Format :attribute jest niepoprawny.',
    'required'             => 'Pole :attribute jest wymagane.',
    'required_if'          => 'Pole :attribute jest wymagane gdy :other ma wartość :value.',
    'required_unless'      => 'Pole :attribute jest wymagane, chyba, że pole :other ma wartość :values.',
    'required_with'        => 'Pole :attribute jest wymagane gdy :values jest wypełnione.',
    'required_with_all'    => 'Pole :attribute jest wymagane gdy :values jest wypełnione.',
    'required_without'     => 'Pole :attribute jest wymagane gdy :values nie jest wypełnione.',
    'required_without_all' => 'Pole :attribute jest wymagane gdy żadne z :values nie są wypełnione.',
    'same'                 => ':attribute i :other muszą mieć takie same wartości.',
    'size'                 => [
        'numeric' => ':attribute musi mieć :size cyfr.',
        'file'    => ':attribute musi mieć :size KB.',
        'string'  => ':attribute musi mieć :size znaków.',
        'array'   => ':attribute musi mieć :size rekordów.',
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