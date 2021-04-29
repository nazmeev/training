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
        echo "manager";
        print_r(get_class($this->manager));
        echo '<br>';
        echo "name=";
        print_r($this->name);
        echo '<br>';
        echo "number=";
        print_r($this->number);
        echo '<br>';
        echo "arrayList=";
        print_r($this->arrayList);
        echo '<br>--';
        echo "newManager=";
        $newManager = $this->managerFactory->create();
        print_r(get_class($newManager));
        echo "<br>";
    }
}
