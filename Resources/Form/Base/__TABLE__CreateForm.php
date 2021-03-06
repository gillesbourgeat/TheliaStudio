<?php
{include "../../includes/header.php"}

namespace {$moduleCode}\Form\Base;

use {$moduleCode}\{$moduleCode};
use Thelia\Form\BaseForm;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class {$table->getTableName()}CreateForm
 * @package {$moduleCode}\Form\Base
 * @author TheliaStudio
 */
class {$table->getTableName()}CreateForm extends BaseForm
{
    const FORM_NAME = "{$table->getRawTableName()}_create";

    public function buildForm()
    {
        $translationKeys = $this->getTranslationKeys();
        $fieldsIdKeys = $this->getFieldsIdKeys();

{foreach from=$table->getColumns() item=column}
{if $column->getFormType() && $column->getName() != 'id' && $column->getName() != 'position'}
        $this->add{$column->getCamelizedName()}Field($translationKeys, $fieldsIdKeys);
{/if}
{/foreach}
{if $table->hasI18nBehavior()}
        $this->addLocaleField();
{/if}
    }
{if $table->hasI18nBehavior()}

    public function addLocaleField()
    {
        $this->formBuilder->add(
            'locale',
            'hidden',
            [
                'constraints' => [ new NotBlank() ],
                'required'    => true,
            ]
        );
    }
{/if}

{foreach from=$table->getColumns() item=column}
{assign type {$column->getFormType()}}
{if $type && $column->getName() != 'id' && $column->getName() != 'position'}
    protected function add{$column->getCamelizedName()}Field(array $translationKeys, array $fieldsIdKeys)
    {
        $this->formBuilder->add("{$column->getName()}", "{$type}", array(
            "label" => $this->translator->trans($this->readKey("{$column->getName()}", $translationKeys), [], {$moduleCode}::MESSAGE_DOMAIN),
            "label_attr" => ["for" => $this->readKey("{$column->getName()}", $fieldsIdKeys)],
{if $type != 'checkbox' && $column->getRequired()}
            "required" => true,
{else}
            "required" => false,
{/if}
            "constraints" => array(
{if $type != 'checkbox' && $column->getRequired()}
                new NotBlank(),
{/if}
            ),
            "attr" => array(
{if $type == "number"}
                "step" => "0.01",
{/if}
            )
        ));
    }

{/if}
{/foreach}
    public function getName()
    {
        return static::FORM_NAME;
    }

    public function readKey($key, array $keys, $default = '')
    {
        if (isset($keys[$key])) {
            return $keys[$key];
        }

        return $default;
    }

    public function getTranslationKeys()
    {
        return array();
    }

    public function getFieldsIdKeys()
    {
        return array(
{foreach from=$table->getColumns() item=column}
{if $column->getFormType() && $column->getName() != 'id'}
            "{$column->getName()}" => "{$table->getRawTableName()}_{$column->getName()}",
{/if}
{/foreach}
        );
    }
}
