<?php
namespace scope\widgets;

use scope\Html;

class PageModuleWidget extends \scope\widgets\Widget{

    public $options = [
        'class' => 'page-modules'
    ];
    public $toolboxOptions = [
        'class' => 'toolbox'
    ];
    public $itemOptions = [
        'class' => 'item'
    ];

    public static function getWidgets(){
        return [
            [
                'name' => 'Slide',
                'description' => 'The default slide provided by Scope.',
                'className' => '\scope\widgets\Slide',
                'options' => [
                    'sc-allow-edit' => '1',
                    'sc-allow-children' => '0',
                    'sc-allow-text-format' => '0',
                    'sc-widget-class' => '\scope\widgets\Slide',
                    'widget-class' => 'scope.slide',
                    'draggable' => 'true'
                ],
                'attributes' => [
                   'options' => [
                        'class' => 'scope slide'
                   ],
                   'items' => [
                       [
                           'img' => 'http://www.carasaven.com/wp-content/uploads/2017/02/banner-option-2.jpg'
                       ],
                       [
                           'img' => 'http://www.carasaven.com/wp-content/uploads/2017/02/banner-option-2.jpg'
                       ]
                   ]
                ]
            ]
        ];
    }
    public static function getHtml(){
        return [
            [
                'name' => 'Paragraph',
                'options' => [
                    'sc-node-type' => 'P',
                    'title' => 'A paragraph',
                    'sc-allow-edit' => '1',
                    'sc-allow-children' => '0',
                    'sc-allow-text-format' => '1',
                    'draggable' => 'true'
                ]
            ],
            [
                'name' => 'Div',
                'options' => [
                    'sc-node-type' => 'DIV',
                    'title' => 'A div',
                    'sc-allow-edit' => '0',
                    'sc-allow-children' => '1',
                    'sc-allow-text-format' => '0',
                    'draggable' => 'true'
                ]
            ]
        ];
    }

    public static function createToolbox( $options ){

        $out = Html::open( 'div', $options );

        $out .= Html::open( 'ul', [] );
        $out .= self::createToolboxWidgets( self::getWidgets() );
        $out .= self::createToolboxHtml( self::getHtml() );
        $out .= Html::close( 'ul' );

        $out .= Html::close( 'div' );

        return $out;
    }

    public static function createToolboxWidgets( $widgets ){
        $out = Html::open( 'li', [
            'sc-on' => 'click',
            'sc-event' => 'toggle',
            'hide' => ''
        ] );
        $out .= Html::label('Widgets', []);
        $out .= Html::open( 'ul' );
        foreach( $widgets as $widget ){
            $options = (isset( $widget['options'] ) ? $widget['options'] : [] );
            $options['title'] = $widget['description'];
            $options['sc-widget-attributes'] = htmlentities( json_encode ( isset($widget['attributes'] ) ? $widget['attributes']  : [] ) );
            $out .= Html::li($widget['name'], $options );
        }
        $out .= Html::close( 'ul' );
        $out .= Html::close( 'li' );
        return $out;
    }

    public static function createToolboxHtml( $html ){
        $out = Html::open( 'li', [
            'sc-on' => 'click',
            'sc-event' => 'toggle',
            'hide' => ''
        ] );
        $out .= Html::label('HTML', []);
        $out .= Html::open( 'ul' );
        foreach( $html as $h ){

            $options = ( isset($h['options']) ? $h['options'] : [] );

            $out .= Html::li($h['name'], $options );
        }
        $out .= Html::close( 'ul' );
        $out .= Html::close( 'li' );
        return $out;
    }

    public function createContent( $options = [] ){
        $out = '';

        if( property_exists($this, 'data') ){
            $attribute = $this->attribute;
            $data = $this->data;
            $content = $data->$attribute;
            $out .= Html::textarea( $content, [
                'name' => FormField::createInputName( $this->data, $this->attribute ),
                'value' => FormField::createInputValue( $this->data, $this->attribute )
            ] );
        }




        $out .= Html::open( 'div', [
            'class' => 'content'
        ] );

        $data = $this->data;
        $content = $data->$attribute;

        $out .= $content;
        $out .= Html::close( 'div' );
        return $out;
    }

    public function prepare( $args ){
        foreach( $args as $k => $v ){
            $this->$k = $v;
        }
    }
    public function run(){
        $out = $this->begin( $this->options );
        $out .= $this->createToolbox( $this->toolboxOptions );
        $out .= $this->createContent( $this->itemOptions );
        $out .= $this->end();
        return $out;
    }

    public function begin( $options = [] ){
        return Html::open('div', $options);
    }
    public function end(){
        return Html::close('div');
    }
}

?>
