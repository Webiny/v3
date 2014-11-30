<?php
require_once 'setup.php';

class ConfigTest
{
    use \Webiny\Component\StdLib\StdLibTrait, \Webiny\Component\Config\ConfigTrait;

    public function run()
    {
        $source1 = $this->arr([
                                  'key1' => [
                                      'data1' => 1,
                                      'data2' => [
                                          [
                                              12,
                                              13,
                                              14
                                          ]
                                      ],
                                      'data3' => 3,
                                      'data5' => [
                                          'name' => [
                                              'some',
                                              'data'
                                          ]
                                      ]
                                  ]
                              ]);

        $source2 = $this->arr([
                                  'key1' => [
                                      'data1' => 2,
                                      'data2' => [
                                          [
                                              1,
                                              2,
                                              3
                                          ],
                                          [
                                              3,
                                              4,
                                              5
                                          ]
                                      ],
                                      'data4' => 'nesto',
                                      'data5' => [
                                          'name' => 'WebinyPlatform'
                                      ]
                                  ]
                              ]);

        die(var_export($source1->mergeSmart($source2)->val(), true));

        print_r(array_merge_recursive($source1->val(), $source2->val()));


        $cfg1 = new \Webiny\Component\Config\ConfigObject($source1);
        $cfg2 = new \Webiny\Component\Config\ConfigObject($source2);

        print_r($source1->mergeSmart($source2)->val());
        die(print_r($cfg1->mergeWith($cfg2)->toArray()));

    }
}

$st = new ConfigTest();
$st->run();