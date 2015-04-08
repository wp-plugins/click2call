<?php 

class Click2Call
{
    public $config = array();

    function __construct($id, $name, $video, $template_botao, $template_popup, $selector) {
        if($video){
            $type = 'call-audiovideo';
        } else {
            $type = 'call-audio';
        }

        $this->config = array(
            "id"    => $id,
            "name"  => $name,
            "type"  => $type,
            "modal" => $template_popup,
            "debug" => false
        );

        $this->template_botao = $template_botao;
        $this->selector = $selector;
    }

    function button() {
        return $this->template_botao;
    }

    function button_script() {
        return "<script type=\"text/javascript\">
        jQuery(function($){
            $('".$this->selector."').click2call(".json_encode($this->config).");
        });
        </script>";
    }
}

