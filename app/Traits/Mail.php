<?php

namespace App\Traits;

trait Mail {

    static function getSubject()
    {
        return 'no subject';
    }


    static function getBody()
    {
        return 'no body';
    }


    static function getModels()
    {
        $models = collect([]);

        foreach((new \ReflectionClass(__class__))->getConstructor()->getParameters() as $param) {
            $models->push((object) [
                'id' => $param->getType()->getName(),
                'name' => $param->getName(),
                'source' => ('{{ $'. $param->getName() .' }}'),
            ]);
        }

        return $models;
    }


    static function getParamsMerge()
    {
        return [];
    }

    static function getParams() {
        $parent = array_keys(get_class_vars(get_parent_class(get_class())));
        $self = array_keys(get_class_vars(get_class()));
        $params = array_diff($self, $parent);
        
        $return = collect([]);

        foreach(self::getModels() as $model) {
            foreach(app($model->id)->getFillable() as $field) {
                $item = new \stdClass;
                $item->id = "\${$model->name}->{$field}";
                $item->name = $field;
                $item->source = "{{ \${$model->name}->{$field} }}";
                $return->push($item);
            }
        }

        return $return;
    }

    public function getParamsValues() {
        $parent = array_keys(get_class_vars(get_parent_class(get_class())));
        $self = array_keys(get_class_vars(get_class()));
        $params = array_diff($self, $parent);

        foreach($params as $i=>$param) {
            $params[$param] = $this->$param;
            unset($params[$i]);
        }
        
        return $params;
    }

    public function bladeCompile($html, $data=[]) {
        $html = \Blade::compileString($html);
        ob_start() and extract($data, EXTR_SKIP);
        try { eval('?>'.$html); }
        catch (\Exception $e) { ob_get_clean(); throw $e; }
        return ob_get_clean();
    }

    public function sendTo($emails) {
        $emails = is_array($emails)? $emails: [$emails];
        $name = (new \ReflectionClass($this))->getShortName();
        
        $data = $this->getParamsValues();
        $subject = $this->bladeCompile(self::getSubject(), $data);
        $template = $this->bladeCompile(self::getBody(), $data);

        \Mail::send([], [], function ($message) use ($emails, $subject, $template) {
            $message->to($emails)->subject($subject)->setBody($template, 'text/html');
        });
    }
}