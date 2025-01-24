// @ts-check

import globals from 'globals'
import eslintJs from '@eslint/js'
import eslintTs from 'typescript-eslint'
import stylistic from '@stylistic/eslint-plugin'
import importPlugin from 'eslint-plugin-import'
import reactPlugin from 'eslint-plugin-react'
import { FlatCompat } from '@eslint/eslintrc'

const compat = new FlatCompat({
	baseDirectory: import.meta.dirname,
	recommendedConfig: eslintJs.configs.recommended
})

export default eslintTs.config(
	eslintJs.configs.recommended,
	...eslintTs.configs.strictTypeChecked,
	...eslintTs.configs.stylisticTypeChecked,
	...compat.extends('plugin:react-hooks/recommended'),
	reactPlugin.configs.flat.recommended,
	importPlugin.flatConfigs.recommended,
	{
		ignores: ['bundle/*', 'src/dist/*', 'src/vendor/*', 'svn/*', 'eslint.config.mjs']
	},
	{
		languageOptions: {
			ecmaVersion: 2018,
			globals: { ...globals.browser },
			parserOptions: {
				ecmaVersion: 2018,
				ecmaFeatures: { jsx: true },
				tsconfigRootDir: import.meta.dirname,
				projectService: { allowDefaultProject: ['eslint.config.mjs'] }
			}
		},
		plugins: {
			'@stylistic': stylistic,
			'react': reactPlugin
		},
		settings: {
			'react': {
				version: 'detect'
			},
			'import/resolver': {
				typescript: {
					alwaysTryTypes: true,
					project: './tsconfig.json',
				}
			}
		},
		rules: {
			'@stylistic/array-bracket-newline': ['error', 'consistent'],
			'@stylistic/arrow-parens': ['error', 'as-needed'],
			'@stylistic/comma-dangle': ['error', 'only-multiline'],
			'@stylistic/dot-location': ['error', 'property'],
			'@stylistic/function-call-argument-newline': ['error', 'consistent'],
			'@stylistic/indent': ['error', 'tab', { SwitchCase: 1 }],
			'@stylistic/jsx-quotes': ['error', 'prefer-double'],
			'@stylistic/linebreak-style': ['error', 'unix'],
			'@stylistic/max-len': ['warn', 140, { ignorePattern: 'd="([\\s\\S]*?)"' }],
			'@stylistic/multiline-ternary': 'off',
			'@stylistic/no-extra-parens': ['error', 'all'],
			'@stylistic/no-mixed-spaces-and-tabs': ['error', 'smart-tabs'],
			'@stylistic/no-tabs': ['error', { allowIndentationTabs: true }],
			'@stylistic/object-property-newline': ['error', { allowAllPropertiesOnSameLine: true }],
			'@stylistic/operator-linebreak': ['error', 'before'],
			'@stylistic/padded-blocks': ['error', 'never'],
			'@stylistic/quote-props': ['error', 'consistent-as-needed'],
			'@stylistic/quotes': ['error', 'single', { avoidEscape: true }],
			'@stylistic/semi': ['error', 'never'],
			'@typescript-eslint/await-thenable': 'error',
			'@typescript-eslint/ban-ts-comment': 'error',
			'@typescript-eslint/consistent-type-assertions': ['error', {
				assertionStyle: 'angle-bracket',
				objectLiteralTypeAssertions: 'never'
			}],
			'@typescript-eslint/consistent-type-imports': 'error',
			'@typescript-eslint/consistent-type-exports': 'error',
			'@typescript-eslint/no-confusing-void-expression': ['error', { ignoreArrowShorthand: true }],
			'@typescript-eslint/no-for-in-array': 'error',
			'@typescript-eslint/no-import-type-side-effects': 'error',
			'@typescript-eslint/no-inferrable-types': ['error', { ignoreProperties: true, ignoreParameters: false }],
			'@typescript-eslint/no-unused-vars': ['error', {
				argsIgnorePattern: '^_',
				varsIgnorePattern: '^_',
				caughtErrorsIgnorePattern: '^_',
				ignoreRestSiblings: true
			}],
			'@typescript-eslint/prefer-includes': 'error',
			'@typescript-eslint/prefer-string-starts-ends-with': 'error',
			'@typescript-eslint/restrict-template-expressions': ['error', { allowNumber: true }],
			'capitalized-comments': ['warn', 'always', {
				ignorePattern: 'translators:',
				ignoreInlineComments: true,
				ignoreConsecutiveComments: true
			}],
			'curly': 'error',
			'dot-notation': 'error',
			'eqeqeq': ['error', 'always'],
			'func-style': ['error', 'expression'],
			'import/export': 'error',
			'import/named': 'error',
			'import/no-duplicates': 'warn',
			'import/no-namespace': 'error',
			'import/no-unresolved': 'error',
			'import/no-useless-path-segments': 'warn',
			'import/order': ['error', {
				'groups': ['builtin', 'external', 'internal', 'parent', 'sibling', 'index', 'object', 'type'],
				'newlines-between': 'never',
				'alphabetize': { orderImportKind: 'asc' }
			}],
			'max-lines-per-function': ['warn', { skipBlankLines: true, skipComments: true }],
			'no-invalid-this': 'error',
			'no-magic-numbers': ['error', { ignore: [-1, 0, 1] }],
			'no-plusplus': ['error', { allowForLoopAfterthoughts: true }],
			'no-ternary': 'off',
			'one-var': ['error', 'never'],
			'prefer-named-capture-group': 'error',
			'prefer-template': 'error',
			'sort-imports': ['error', { ignoreDeclarationSort: true }],
			'yoda': ['error', 'always']
		}
	},
	{
		files: ['**/*.tsx'],
		rules: {
			'@typescript-eslint/consistent-type-assertions': ['error', {
				assertionStyle: 'as',
				objectLiteralTypeAssertions: 'never'
			}],
		}
	}
)
