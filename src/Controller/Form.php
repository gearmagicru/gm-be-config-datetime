<?php
/**
 * Этот файл является частью расширения модуля веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Backend\Config\DateTime\Controller;

use Gm;
use Gm\Panel\Widget\EditWindow;
use Gm\Backend\Config\Controller\ServiceForm;

/**
 * Контроллер конфигурации службы "Дата и Время".
 * 
 * Cлужба {@see \Gm\I18n\Formatter}.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Backend\Config\DateTime\Controller
 * @since 1.0
 */
class Form extends ServiceForm
{
    /**
     * Возвращает элементы панели формы (Gm.view.form.Panel GmJS).
     * 
     * @return array
     */
    protected function getFormItems(): array
    {
        $dateFormat = Gm::$app->formatter->formatWithoutPrefix('dateFormat', 'php:');
        $dateFormats = [
            'd.m.Y' => $dateFormat == 'd.m.Y',
            'd/m/Y' => $dateFormat == 'd/m/Y',
            'd-m-Y' => $dateFormat == 'd-m-Y',
            'm.d.Y' => $dateFormat == 'm.d.Y',
            'm/d/Y' => $dateFormat == 'm/d/Y',
            'm-d-Y' => $dateFormat == 'm-d-Y'
        ];
        $dateCustom = true;
        foreach($dateFormats as $date => $checked) {
            if ($checked) {
                $dateCustom = false;
                break;
            }
        }
        // формат времени
        $timeFormat = Gm::$app->formatter->formatWithoutPrefix('timeFormat', 'php:');
        $timeFormats = [
            'H:i:s' => $timeFormat == 'H:i:s',
            'H:i'   => $timeFormat == 'H:i',
            'g:i A' => $timeFormat == 'g:i A'
        ];
        $timeCustom = true;
        foreach($timeFormats as $time => $checked) {
            if ($checked) {
                $timeCustom = false;
                break;
            }
        }
        return [
            [
                'xtype'       => 'fieldset',
                'title'       => '#Date format',
                'collapsible' => true,
                'layout' => 'column',
                'items' => [
                    [
                        'width' => 120,
                        'items' => [
                            ['xtype' => 'radio', 'boxLabel' => date('d.m.Y'), 'name' => 'dateFormat', 'inputValue' => 'd.m.Y', 'checked' => $dateFormats['d.m.Y']],
                            ['xtype' => 'radio', 'boxLabel' => date('d/m/Y'), 'name' => 'dateFormat', 'inputValue' => 'd/m/Y', 'checked' => $dateFormats['d/m/Y']],
                            ['xtype' => 'radio', 'boxLabel' => date('d-m-Y'), 'name' => 'dateFormat', 'inputValue' => 'd-m-Y', 'checked' => $dateFormats['d-m-Y']],
                            ['xtype' => 'radio', 'boxLabel' => '#Arbitrarily', 'name' => 'dateFormat', 'inputValue' => 'custom', 'checked' => $dateCustom],
                        ]
                    ],
                    [
                        'width' => 80,
                        'items' => [
                             ['html' => '<span class="g-formatter-date">d.m.Y</span>', 'height' => 30],
                             ['html' => '<span class="g-formatter-date">d/m/Y</span>', 'height' => 30],
                             ['html' => '<span class="g-formatter-date">d-m-Y</span>', 'height' => 30],
                             [
                                'xtype' => 'textfield',
                                'name'  => 'dateFormatCustom]',
                                'value' => $dateCustom ? $dateFormat : '',
                                'width' => 70
                             ]
                        ]
                    ],
                    [
                        'width' => 120,
                        'items' => [
                            ['xtype' => 'radio', 'boxLabel' => date('m.d.Y'), 'name' => 'dateFormat', 'inputValue' => 'm.d.Y', 'checked' => $dateFormats['m.d.Y']],
                            ['xtype' => 'radio', 'boxLabel' => date('m/d/Y'), 'name' => 'dateFormat', 'inputValue' => 'm/d/Y', 'checked' => $dateFormats['m/d/Y']],
                            ['xtype' => 'radio', 'boxLabel' => date('m-d-Y'), 'name' => 'dateFormat', 'inputValue' => 'm-d-Y', 'checked' => $dateFormats['m-d-Y']],
                        ]
                    ],
                    [
                        'width' => 80,
                        'items' => [
                             ['html' => '<span class="g-formatter-date">m.d.Y</span>', 'height' => 30],
                             ['html' => '<span class="g-formatter-date">m/d/Y</span>', 'height' => 30],
                             ['html' => '<span class="g-formatter-date">m-d-Y</span>', 'height' => 30]
                        ]
                    ]
                ]
            ],
            [
                'xtype'       => 'fieldset',
                'title'       => '#Time format',
                'collapsible' => true,
                'layout' => 'column',
                'items' => [
                    [
                        'width' => 120,
                        'items' => [
                            ['xtype' => 'radio', 'boxLabel' => date('H:i:s'), 'name' => 'timeFormat', 'inputValue' => 'H:i:s', 'checked' => $timeFormats['H:i:s']],
                            ['xtype' => 'radio', 'boxLabel' => date('H:i'), 'name' => 'timeFormat', 'inputValue' => 'H:i', 'checked' => $timeFormats['H:i']],
                            ['xtype' => 'radio', 'boxLabel' => date('g:i A'), 'name' => 'timeFormat', 'inputValue' => 'g:i A', 'checked' => $timeFormats['g:i A']],
                            ['xtype' => 'radio', 'boxLabel' => '#Arbitrarily', 'name' => 'timeFormat', 'inputValue' => 'custom', 'checked' => $timeCustom]
                        ]
                    ],
                    [
                        'width' => 80,
                        'items' => [
                            ['html' => '<span class="g-formatter-date">H:i:s</span>', 'height' => 30],
                            ['html' => '<span class="g-formatter-date">H:i</span>', 'height' => 30],
                            ['html' => '<span class="g-formatter-date">g:i A</span>', 'height' => 30],
                            ['xtype' => 'textfield',
                                'name'  => 'timeFormatCustom',
                                'value' => $timeCustom ? $timeFormat : '',
                                'width' => 70
                            ],
                        ]
                    ]
                ]
            ],
            [
                'html' => '<a class="g-setting-link" target="_blank" href="https://www.php.net/manual/ru/function.date">' . $this->module->t('Details on date and time formats') . '</a>'
            ],
            [
                'xtype'  => 'toolbar',
                'dock'   => 'bottom',
                'border' => 0,
                'style'  => ['borderStyle' => 'none'],
                'items'  => [
                    [
                        'xtype'    => 'checkbox',
                        'boxLabel' => $this->module->t('reset settings'),
                        'name'     => 'reset',
                        'ui'       => 'switch'
                    ]
                ]
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function createWidget(): EditWindow
    {
        /** @var EditWindow $window */
        $window = parent::createWidget();

        // окно компонента (Ext.window.Window Sencha ExtJS)
        $window->autoHeight = true;
        $window->width = 500;

        // панель формы (Gm.view.form.Panel GmJS)
        $window->form->items = $this->getFormItems();
        $window->requires = [
            'Gm.view.window.Window',
            'Gm.view.form.Panel',
            'Gm.view.form.field.TreeComboBox'
        ];
        return $window;
    }
}
