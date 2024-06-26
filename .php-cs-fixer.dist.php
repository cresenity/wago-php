<?php
$config = new PhpCsFixer\Config();

$finder = PhpCsFixer\Finder::create()
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return $config->setFinder($finder)->setRules([
    'array_indentation' => true,
    'array_syntax' => ['syntax' => 'short'],
    'combine_consecutive_unsets' => true,
    'combine_consecutive_issets' => true,
    'class_attributes_separation' => [
        'elements' => [
            'const' => 'one',
            'method' => 'one',
            'property' => 'one',
            'trait_import' => 'none'
        ]
    ],
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],
    'encoding' => true,
    'explicit_string_variable' => false,
    'single_quote' => true,
    'constant_case' => true,
    'binary_operator_spaces' => [
        'default' => 'single_space',
        'operators' => [
            '=>' => 'single_space'
        ]

    ],
    'blank_line_before_statement' => true,
    'function_declaration' => true,
    // 'blank_line_after_opening_tag' => true,
    // 'blank_line_before_return' => true,
    'braces' => [
        'allow_single_line_closure' => true,
        'position_after_functions_and_oop_constructs' => 'same',
        'position_after_anonymous_constructs' => 'same',
        'position_after_control_structures' => 'same',
    ],
    'cast_spaces' => true,
    'class_definition' => [
        'multi_line_extends_each_single_line' => false,
        'single_item_single_line' => false,
        'single_line' => true,
        'space_before_parenthesis' => false,
    ],
    'clean_namespace' => true,
    'concat_space' => ['spacing' => 'one'],
    'declare_equal_normalize' => true,
    'function_typehint_space' => true,
    //'hash_to_slash_comment' => true,
    'include' => true,
    'lowercase_cast' => true,
    //'backtick_to_shell_exec' => true,
    // 'new_with_braces' => true,
    'no_blank_lines_after_class_opening' => true,
    'no_blank_lines_after_phpdoc' => true,
    'full_opening_tag' => true,
    'no_break_comment' => true,
    'no_empty_comment' => true,
    'no_empty_phpdoc' => true,
    'no_empty_statement' => true,
    'no_closing_tag' => true,
    'no_extra_blank_lines' => true,
    'no_leading_import_slash' => true,
    'align_multiline_comment' => true,
    'no_multiline_whitespace_around_double_arrow' => true,
    // 'no_extra_consecutive_blank_lines' => [
    //     'curly_brace_block',
    //     'extra',
    //     'parenthesis_brace_block',
    //     'square_brace_block',
    //     'throw',
    //     'use',
    // ],
    // 'no_leading_import_slash' => true,
    // 'no_leading_namespace_whitespace' => true,
    // 'no_mixed_echo_print' => array('use' => 'echo'),
    'no_multiline_whitespace_around_double_arrow' => true,
    // 'no_short_bool_cast' => true,
    'elseif' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'no_spaces_around_offset' => true,
    'no_spaces_inside_parenthesis' => true,
    //'ereg_to_preg' => true, // risky
    //'no_superfluous_elseif' => true,
    'no_superfluous_phpdoc_tags' => true,
    'no_trailing_whitespace' => true,
    'no_unneeded_control_parentheses' => true,
    // 'no_trailing_comma_in_list_call' => true,
    // 'no_trailing_comma_in_singleline_array' => true,
    // 'no_unneeded_control_parentheses' => true,
    // 'no_unused_imports' => true,
    'no_whitespace_before_comma_in_array' => true,
    'no_whitespace_in_blank_line' => true,
    'normalize_index_brace' => true,
    // 'normalize_index_brace' => true,
    'object_operator_without_whitespace' => true,
    // 'php_unit_fqcn_annotation' => true,
    'phpdoc_align' => [
        'align' => 'vertical',
        'tags' => [
            'method',
            'param',
            'property',
            'property-read',
            'property-write',
            'return',
            'throws',
            'type',
            'var',
        ]
    ],
    'phpdoc_add_missing_param_annotation' => true,
    'phpdoc_inline_tag_normalizer' => [
        'tags' => [
            'example',
            'id',
            'internal',
            'inheritdoc',
            'inheritdocs',
            'link',
            'source',
            'toc',
            'tutorial',
        ]
    ],
    'phpdoc_annotation_without_dot' => true,
    'phpdoc_indent' => true,
    'phpdoc_line_span' => true,
    'phpdoc_order' => true,
    // 'phpdoc_order_by_value' => [
    //     'annotations' => ['author', 'covers', 'coversNothing', 'dataProvider', 'depends', 'group', 'internal', 'method', 'property', 'property-read', 'property-write', 'requires', 'throws', 'uses']
    // ],
    // 'phpdoc_inline_tag' => true,
    'phpdoc_no_access' => true,
    // 'phpdoc_no_alias_tag' => true,
    // 'phpdoc_no_empty_return' => true,
    // 'phpdoc_no_package' => true,
    // 'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_return_self_reference' => [
        'replacements' => [
            'this' => '$this', '@this' => '$this', '$self' => 'self', '@self' => 'self', '$static' => 'static', '@static' => 'static'
        ]
    ],
    'phpdoc_scalar' => true,
    'phpdoc_separation' => true,
    'phpdoc_var_annotation_correct_order' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_summary' => true,
    'phpdoc_tag_type' => [
        'tags' => ['api' => 'annotation',
            'author' => 'annotation',
            'copyright' => 'annotation',
            'deprecated' => 'annotation',
            'example' => 'annotation',
            'global' => 'annotation',
            'inheritDoc' => 'annotation',
            'internal' => 'annotation',
            'license' => 'annotation',
            'method' => 'annotation',
            'package' => 'annotation',
            'param' => 'annotation',
            'property' => 'annotation',
            'return' => 'annotation',
            'see' => 'annotation',
            'since' => 'annotation',
            'throws' => 'annotation',
            'todo' => 'annotation',
            'uses' => 'annotation',
            'var' => 'annotation',
            'version' => 'annotation'
        ]
    ],
    'ordered_class_elements' => [
        'order' => [
            'use_trait',
            'constant_public',
            'constant_protected',
            'constant_private',
            'property_public',
            'property_protected',
            'property_private',
        ],
    ],
    // 'phpdoc_summary' => true,
    // 'phpdoc_to_comment' => true,
    'phpdoc_trim' => true,
    'phpdoc_trim_consecutive_blank_line_separation' => true,
    'phpdoc_var_annotation_correct_order' => true,
    'phpdoc_types_order' => [
        'null_adjustment' => 'always_first',
        'sort_algorithm' => 'none',
    ],
    'phpdoc_types' => true,
    'phpdoc_var_without_name' => true,
    'general_phpdoc_tag_rename' => [
        'case_sensitive' => false,
        'fix_annotation' => true,
        'fix_inline' => true,
        'replacements' => [
            'inheritDocs' => 'inheritDoc'
        ],
    ],
    'general_phpdoc_annotation_remove' => [
        'annotations' => ['package', 'subpackage'],
    ],
    // 'pre_increment' => true,
    // 'return_type_declaration' => true,
    // 'self_accessor' => true,
    // 'short_scalar_cast' => true,
    'single_blank_line_before_namespace' => true,
    // 'single_class_element_per_statement' => true,
    // 'space_after_semicolon' => true,
    // 'standardize_not_equals' => true,
    'ternary_operator_spaces' => true,
    // 'trailing_comma_in_multiline_array' => true,
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'whitespace_after_comma_in_array' => true,
    'switch_case_space' => true,
    'operator_linebreak' => [
        'only_booleans' => false,
        'position' => 'beginning',
    ],
    'native_function_casing' => true,
    'native_function_type_declaration_casing' => true,
    'magic_constant_casing' => true,
    'magic_method_casing' => true,
    'lowercase_static_reference' => true,
    'linebreak_after_opening_tag' => true,
    'lowercase_keywords' => true,
    'method_argument_space' => [
        'after_heredoc' => false,
        'keep_multiple_spaces_after_comma' => false,
        'on_multiline' => 'ensure_fully_multiline',
    ],
    'semicolon_after_instruction' => true,
    'new_with_braces' => true,
    'types_spaces' => [
        'space' => 'none',
    ],
    'echo_tag_syntax' => [
        'format' => 'long',
        'long_function' => 'echo',
        'shorten_simple_statements_only' => true,
    ],
    'method_chaining_indentation' => true,
    'no_superfluous_phpdoc_tags' => false,
    'multiline_comment_opening_closing' => true,

    'ordered_imports' => [
        'sort_algorithm' => 'length'
    ],
    'fully_qualified_strict_types' => true,
    'line_ending' => true,
    'list_syntax' => [
        'syntax' => 'long',
    ],
    'single_import_per_statement' => true,
    'single_line_after_imports' => true,
])->setLineEnding("\n");
