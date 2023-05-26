<?php

namespace Core;

class Controller
{
//Методы для возможных дополнительных проверок. Также данный класс "родитель" может
//расширятся при масштабировании проекта

    public function before(string $action)
    {
        return true;
    }

    public function after(){}
}