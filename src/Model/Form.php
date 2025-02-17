<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\Config\DateTime\Model;

use Gm;
use Gm\Backend\Config\Model\ServiceForm;

/**
 * Модель данных конфигурации службы "Дата и Время".
 * 
 * Cлужба {@see \Gm\I18n\Formatter}.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\Config\DateTime\Model
 * @since 1.0
 */
class Form extends ServiceForm
{
    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        $this->unifiedName = Gm::$app->formatter->getObjectName();
    }

    /**
     * {@inheritdoc}
     */
    public function maskedAttributes(): array
    {
        return [
            'timeFormat'       => 'timeFormat',
            'dateFormat'       => 'dateFormat',
            'dateTimeFormat'   => 'dateTimeFormat',
            'timeFormatCustom' => 'timeFormatCustom',
            'dateFormatCustom' => 'dateFormatCustom',
            // опции другой службы (разделены интерфейсом настроек)
            'timeZone'         => 'timeZone',
            'firstWeekDay'     => 'firstWeekDay',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function excludedAttributes(): array
    {
        return ['timeZone', 'firstWeekDay'];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave(bool $isInsert): bool
    {
        if ($this->dateFormat == 'custom') {
            $this->dateFormat = $this->dateFormatCustom;
        }
        if ($this->timeFormat == 'custom') {
            $this->timeFormat = $this->timeFormatCustom;
        }
        if (isset($this->dateFormatCustom))
            unset($this->dateFormatCustom);
        if (isset($this->timeFormatCustom))
            unset($this->timeFormatCustom);

        $this->dateTimeFormat = 'php:' . $this->dateFormat;
        if ($this->dateFormat) {
            $this->dateFormat = 'php:' . $this->dateFormat;
        }
        if ($this->timeFormat) {
            $this->dateTimeFormat .= ' ' . $this->timeFormat;
            $this->timeFormat = 'php:' . $this->timeFormat;
             
        }

        return parent::beforeSave($isInsert);
    }

    /**
     * {@inheritDoc}
     */
    public function afterValidate(bool $isValid): bool
    {
        if ($isValid) {
            if ($this->dateFormat == 'custom') {
                if (empty($this->dateFormatCustom)) {
                    $this->addError($this->t('No custom date format specified'));
                    return false;
                }
            }
            if ($this->timeFormat == 'custom') {
                if (empty($this->dateFormatCustom)) {
                    $this->addError($this->t('No custom time format specified'));
                    return false;
                }
            }
        }
        return $isValid;
    }
}
