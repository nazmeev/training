<?php

namespace Training\TestOM\Model;

class Test
{
    private $manager;
    private $arrayList;
    private $name;
    private $number;
    private $managerFactory;

    public function __construct(
        ManagerInterface $manager,
        array $arrayList,
        string $name,
        float $number,
        ManagerInterfaceFactory $managerFactory
    )
    {
        $this->manager = $manager;
        $this->arrayList = $arrayList;
        $this->name = $name;
        $this->number = $number;
        $this->managerFactory = $managerFactory;
    }

    public function log()
    {
        print_r(get_class($this->manager));
        echo '<br>';
        print_r($this->name);
        echo '<br>';
        print_r($this->number);
        echo '<br>';
        print_r($this->arrayList);
        echo '<br>--';
        $newManager = $this->managerFactory->create();
        print_r(get_class($newManager));
    }
}
