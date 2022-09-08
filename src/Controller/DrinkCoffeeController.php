<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace App\Controller;

use App\Entity\KaffeeMaschine;
use App\Entity\Mensch;
use App\Menu\MenuBuilder;
use Core\Controller\AbstractController;

class DrinkCoffeeController extends AbstractController
{

    protected array $ausgabe = [];

    public function index(): string
    {
        $mainMenu = new MenuBuilder();
        $mainMenu->createMenu();

        $human = new Mensch();
        $this->addMessage('Mensch erstellt.');
        $human->setIsTired(false);
        $this->addMessage('Mensch munter gemacht.');
        $this->addMessage('Prüfen, ob Mensch müde ist.');
        $this->checkState($human);
        $this->addMessage('Prüfen, ob Mensch müde ist, abgeschlossen');
        $coffeeMaschine = new KaffeeMaschine();
        $this->addMessage('Kaffeemaschine erstellt.');

        return $this->render('coffee/index.html',[
            'mainMenu' => $mainMenu->render(),
            'km' => $coffeeMaschine,
            'h' => $human,
            'message' => $this->ausgabe,
        ]);
    }

    public function checkState(Mensch $human)
    {
        while ($human->isTired() === false)
        {
            $this->addMessage('Mensch ist nicht müde.');
            $human->setIsTired(true);
            $this->addMessage('Mensch ist wieder müde.');
        }
    }

    protected function addMessage(string $message): DrinkCoffeeController
    {
        $this->ausgabe[] = $message;
        return $this;
    }

}
