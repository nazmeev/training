<?php
namespace Training\TestOM\Model;

class PlayWithTest{
    private $testObjectFactory;
    private $testObject;
    private $manager;
    private $arrayList;

    public function __construct(
        Test $testObject,
        TestFactory $testObjectFactory,
        array $arrayList,
        ManagerCustomImplementation $manager2
    ) {
        $this->arrayList = $arrayList;
        $this->testObject = $testObject;
        $this->testObjectFactory = $testObjectFactory;
        $this->manager = $manager2;
    }

    public function run()
    {
// test object with constructor arguments managed by di.xml
        $this->testObject->log();
// test object with custom constructor arguments
// some arguments are defined here, others - from di.xml
        $customArrayList = ['item1' => 'aaaaa', 'item2' => 'bbbbb'];

        $newTestObject = $this->testObjectFactory->create([
            'arrayList' => $customArrayList,
            'manager' => $this->manager
        ]);
        $newTestObject->log();
    }

}
